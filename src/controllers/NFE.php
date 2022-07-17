<?php
namespace Controller;

use InvalidArgumentException;
use Model\Clientes_Model;
use Model\Empresas_Model;
use Model\Fornecedor_Model;
use Model\NFE_Model;
use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\Common\Soap\SoapCurl;
use Alertas\Alert;
use NFePHP\DA\NFe\Danfe;
use Model\NFE_Produtos_Model;

class NFE extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
        $this->permissoes('nfe');
    }

    public function home(){
        $this->render("nfe");
    }

    public function tabela(){
        $model = new NFE_Model();
        $lista = $model->lista();
        if($lista == null){
            $tabela["data"] = [];
        }else{
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
                    "<a href='javascript:void(0)' onclick='danfe(\"/nfe/danfe/$nfe->id\")'><img src='/assets/images/pdf.png' class='imagem-acao' data-role='hint' data-hint-text='DANFE'></a>
                 <a href='javascript:void(0)' onclick='excluir(\"$nfe->chave\")'><img id='excluir' src='/assets/images/excluir.png' data-role='hint' data-hint-text='Excluir Nota' class='imagem-acao'></a>
                "
                ];
            }
        }
        echo json_encode($tabela);
    }

    public function excluir(){
        $chave = $_POST["chave"];
        $nfeModel = new NFE_Model();
        $retorno = $nfeModel->excluir($chave);
        if($retorno["status"] == false){
            echo json_encode($retorno);
        }else{
            unlink(__DIR__."/../../files/nfe/xml/".$chave.".xml");
            echo json_encode($retorno);
        }
    }

    public function danfe($data){
        $nfeModel = new NFE_Model();
        $dadosNFE = $nfeModel->dados($data["id"]);

        $xml = file_get_contents(__DIR__."/../../files/nfe/xml/".$dadosNFE->chave.".xml");
        $logo = "";

        try {
            $danfe = new Danfe($xml);
            $danfe->exibirTextoFatura = false;
            $danfe->exibirPIS = false;
            $danfe->exibirIcmsInterestadual = false;
            $danfe->exibirValorTributos = false;
            $danfe->descProdInfoComplemento = false;
            $danfe->setOcultarUnidadeTributavel(true);
            $danfe->obsContShow(false);
            $danfe->printParameters(
                $orientacao = 'P',
                $papel = 'A4',
                $margSup = 2,
                $margEsq = 2
            );
            $danfe->logoParameters($logo, $logoAlign = 'C', $mode_bw = false);
            $danfe->setDefaultFont($font = 'times');
            $danfe->setDefaultDecimalPlaces(4);
            $danfe->debugMode(false);
            $danfe->creditsIntegratorFooter('ERPCASTRO - http://www.erpcastro.com.br');
            //$danfe->epec('891180004131899', '14/08/2018 11:24:45'); //marca como autorizada por EPEC

            // Caso queira mudar a configuracao padrao de impressao
            /*  $this->printParameters( $orientacao = '', $papel = 'A4', $margSup = 2, $margEsq = 2 ); */
            // Caso queira sempre ocultar a unidade tributável
            /*  $this->setOcultarUnidadeTributavel(true); */
            //Informe o numero DPEC
            /*  $danfe->depecNumber('123456789'); */
            //Configura a posicao da logo
            /*  $danfe->logoParameters($logo, 'C', false);  */
            //Gera o PDF
            $pdf = $danfe->render($logo);
            header('Content-Type: application/pdf');
            echo $pdf;
        } catch (InvalidArgumentException $e) {
            Alert::error("Ocorreu um erro durante o processamento", $e->getMessage(), "");
            exit();
        }
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
                    $nfeProdutos = new NFE_Produtos_Model();
                    $nfeProdutos->cadastrar($xml->protNFe->infProt->chNFe, $d->prod->xProd, (float)$d->prod->vUnCom, $d->prod->cEAN, (int)$d->prod->qCom, $d->prod->uCom);
                   /* $produtos[] = [
                        "codigoBarras" => $d->prod->cEAN,
                        "produto" => $d->prod->xProd,
                        "valorProduto" => $d->prod->vUnCom,
                        "quantidade" => $d->prod->qCom,
                        "unidade" => $d->prod->uCom
                    ];*/
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
                if(!file_exists("../../files/nfe/xml/")){
                    mkdir("../../files/nfe/xml/", 0777, true);
                }
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
