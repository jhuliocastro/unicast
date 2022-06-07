<?php
namespace Controller;

use CoffeeCode\Uploader\Send;
use Core\TButton;
use Core\TForm;
use Core\TPage;
use Core\TTable;
use Model\Clientes_Model;
use Model\Empresas_Model;
use Model\Fornecedor_Model;
use Model\NFE_Model;
use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\Common\Soap\SoapCurl;
use Alertas\Alert;

class NFE extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        $page = new TPage(0, "NFE");

        $table = new TTable("tabela");
        $table->addColumn("ID");
        $table->addColumn("Nº NFe");
        $table->addColumn("Empresa");
        $table->addColumn("Fornecedor");
        $table->addColumn("Valor");
        $table->addColumn("Data Emissão");
        $table->addColumn("Ações");
        $table->urlData("/nfe/tabela");
        $table->order(5, "desc");
        $table = $table->close();

        $botaoImportar = new TButton();
        $botaoImportar->title("Importar XML");
        $botaoImportar->id("botaoImportarXML");
        $botaoImportar->action(2);
        $botaoImportar->url("/nfe/importar/xml");
        $botaoImportar = $botaoImportar->show();

        $page->addButton($botaoImportar);
        $page->addTable($table);

        $page->close();
    }

    public function tabela(){
        $model = new NFE_Model();
        $lista = $model->lista();
        foreach($lista as $nfe){
            $fornecedor = new Fornecedor_Model();
            $fornecedor = $fornecedor->findById($nfe->fornecedor);

            $empresa = new Empresas_Model();
            $empresa = $empresa->findById($nfe->empresa);

            $tabela["data"][] = [
                $nfe->id,
                $nfe->chave,
                $empresa->razaoSocial,
                $fornecedor->razaoSocial,
                "R$ ".number_format($nfe->valor, 2, ",", "."),
                date("d/m/Y", strtotime($nfe->emissao)),
                ""
            ];
        }

        echo json_encode($tabela);
    }

    public function importarXML(){
        $page = new TPage(1, "Importar XML");

        $form = new TForm("formImportar", "post", "/nfe/importar/xml", true);
        $form->addInput("xml", "Selecione o XML", "file", true, null);
        $form->addSubmit("botaoImportar", "Importar");

        $page->addForm($form->show());
        $page->close();
    }

    public function importarXMLSender(){
        $files = $_FILES;
        if(empty($files["xml"])){
            Alert::error("Arquivo não enviado!", "Verifique e tente novamente.", "/nfe/importar/xml");
        }else{
            if($files["xml"]["type"] != "text/xml"){
                Alert::error("Selecione um XML válido!", "", "/nfe/importar/xml");
            }else{
                $xml = simplexml_load_file($files["xml"]["tmp_name"]);

                //PRODUTOS
                $produtos = [];
                foreach($xml->NFe->infNFe->det as $d){
                    //var_dump($d);
                    $produtos[] = [
                        "codigoBarras" => $d->prod->cEAN,
                        "produto" => $d->prod->xProd,
                        "valorProduto" => $d->prod->vUnCom,
                        "quantidade" => $d->prod->qCom,
                        "unidade" => $d->prod->uCom
                    ];
                }

                //DADOS DA NFE
                $nfe["valor"] = $xml->NFe->infNFe->total->ICMSTot->vNF;
                $nfe["dataEmissao"] = date('Y-m-d', strtotime($xml->NFe->infNFe->ide->dhEmi));
                $nfe["chave"] = $xml->protNFe->infProt->chNFe;

                //DADOS DO EMITENTE
                $emitente["cnpj"] = $xml->NFe->infNFe->emit->CNPJ;
                $emitente["razaoSocial"] = $xml->NFe->infNFe->emit->xNome;
                $emitente["nomeFantasia"] = $xml->NFe->infNFe->emit->xFant;
                $emitente["logradouro"] = $xml->NFe->infNFe->emit->enderEmit->xLgr;
                $emitente["numero"] = $xml->NFe->infNFe->emit->enderEmit->nro;
                $emitente["bairro"] = $xml->NFe->infNFe->emit->enderEmit->xBairro;
                $emitente["cidade"] = $xml->NFe->infNFe->emit->enderEmit->xMun;
                $emitente["estado"] = $xml->NFe->infNFe->emit->enderEmit->UF;
                $emitente["cep"] = $xml->NFe->infNFe->emit->enderEmit->CEP;

                //DADOS DO DESTINATARIO
                $destinatario["cnpj"] = $xml->NFe->infNFe->dest->CNPJ;
                $destinatario["razaoSocial"] = $xml->NFe->infNFe->dest->xNome;
                $destinatario["nomeFantasia"] = $xml->NFe->infNFe->dest->xFant;
                $destinatario["logradouro"] = $xml->NFe->infNFe->dest->enderDest->xLgr;
                $destinatario["numero"] = $xml->NFe->infNFe->dest->enderDest->nro;
                $destinatario["bairro"] = $xml->NFe->infNFe->dest->enderDest->xBairro;
                $destinatario["cidade"] = $xml->NFe->infNFe->dest->enderDest->xMun;
                $destinatario["estado"] = $xml->NFe->infNFe->dest->enderDest->UF;
                $destinatario["cep"] = $xml->NFe->infNFe->dest->enderDest->CEP;
            }

            //VERIFICA SE O EMITENTE JA EXISTE
            $fornecedorModel = new Fornecedor_Model();
            $retorno = $fornecedorModel->verificaExiste($emitente["cnpj"]);
            if($retorno["status"] == false){
                $retorno["error"] = str_replace("'", "", $retorno["error"]);
                Alert::error("Erro ao realizar busca do fornecedor.", $retorno["error"], "/nfe");
                exit();
            }else{
                if($retorno["existe"] == false){
                    $retorno = $fornecedorModel->cadastrar($emitente);
                    if($retorno["status"] == false){
                        $retorno["error"] = str_replace("'", "", $retorno["error"]);
                        Alert::error("Erro ao cadastrar fornecedor.", $retorno["error"], "/nfe");
                        exit();
                    }
                }
                $retorno = $fornecedorModel->dados($emitente["cnpj"]);
                $emitente["id"] = $retorno->id;
            }

            //VERIFICA SE DESTINARIO EXISTE E GRAVA NO BANCO
            $empresasModel = new Empresas_Model();
            $retorno = $empresasModel->checkExist("cnpj", $destinatario["cnpj"]);
            if($retorno["status"] == false){
                $retorno["error"] = str_replace("'", "", $retorno["error"]);
                Alert::error("Erro ao realizar busca da empresa.", $retorno["error"], "/nfe");
                exit();
            }else{
                if($retorno["exist"] == false){
                    $retorno = $empresasModel->register($destinatario);
                    if($retorno["status"] == false){
                        $retorno["error"] = str_replace("'", "", $retorno["error"]);
                        Alert::error("Erro ao cadastrar empresa.", $retorno["error"], "/nfe");
                        exit();
                    }
                }
                $retorno = $empresasModel->dados($destinatario["cnpj"]);
                $destinatario["id"] = $retorno->id;
            }

            //GRAVA DOS DADOS DA NFE
            $nfeModel = new NFE_Model();

            //VERIFICA SE A NOTA JA ESTA CADASTRADA
            $retorno = $nfeModel->verificaExiste($nfe["chave"]);

            //CONDICAO NA BUSCA DA NOTA NO BANCO DE DADOS
            if($retorno["status"] == false){
                $retorno["error"] = str_replace("'", "", $retorno["error"]);
                Alert::error("Erro ao realizar busca da nota.", $retorno["error"], "/nfe");
                exit();
            }else{
                if($retorno["existe"] == true){
                    Alert::warning("Nota já está cadastrada!", "Verifique os dados.", "/nfe");
                    exit();
                }
            }

            $retorno = $nfeModel->cadastrar($nfe["chave"], $destinatario["id"], $emitente["id"], (float)$nfe["valor"], $nfe["dataEmissao"]);

            if($retorno["status"] == false){
                $retorno["error"] = str_replace("'", "", $retorno["error"]);
                Alert::error("Erro ao cadastrar NFE", $retorno["error"], "/nfe");
                exit();
            }else{
                //UPLOAD DO XML
                $arquivo = __DIR__."/../../files/nfe/xml/".$nfe["chave"].".xml";
                $retorno = move_uploaded_file($files["xml"]["tmp_name"], $arquivo);
                if($retorno == false){
                    Alert::warning("Nota foi cadastrada mas o upload do xml falhou!", "Contato o suporte.", "/nfe");
                    exit();
                }
            }
        }

        Alert::success("Nota Importada!", "", "/nfe");
    }

    public function manifestacao(){
      $arr = [
        "atualizacao" => "2017-02-20 09:11:21",
        "tpAmb" => 2,
        "razaosocial" => "SUA RAZAO SOCIAL LTDA",
        "cnpj" => "99999999999999",
        "siglaUF" => "SP",
        "schemes" => "PL_009_V4",
        "versao" => '4.00',
        "tokenIBPT" => "AAAAAAA",
        "CSC" => "GPB0JBWLUR6HWFTVEAS6RJ69GPCROFPBBB8G",
        "CSCid" => "000001",
        "proxyConf" => [
            "proxyIp" => "",
            "proxyPort" => "",
            "proxyUser" => "",
            "proxyPass" => ""
        ]
    ];
    $configJson = json_encode($arr);
    $pfxcontent = file_get_contents('fixtures/expired_certificate.pfx');

    $tools = new Tools($configJson, Certificate::readPfx($pfxcontent, 'associacao'));
    $tools->model('55');

    //sempre que ativar a contingência pela primeira vez essa informação deverá ser
    //gravada na base de dados ou em um arquivo para uso posterior, até que a mesma seja
    //desativada pelo usuário, essa informação não é persistida automaticamente e depende
    //de ser gravada pelo ERP
    $contingencia = $tools->contingency->deactivate();

    //e se necessário carregada novamente quando a classe for instanciada
    $tools->contingency->load($contingencia);

    //executa a busca por documentos
    $response = $tools->sefazDistDFe(
        'AN',
        $arr['cnpj'],
        0,
        0
    );

    echo "<pre>";
    print_r($response);
    echo "</pre>";

        parent::render("manifestacao");
    }
}
