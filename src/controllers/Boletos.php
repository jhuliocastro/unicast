<?php
namespace Controller;

use Model\Boletos_Model;
use Model\Empresas_Model;
use Model\Fornecedor_Model;
use Alertas\Alert;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorSVG;

class Boletos extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        $this->permissoes("boletos");

        $fornecedor = new Fornecedor_Model();
        $fornecedores = $fornecedor->lista();
        $fornecedoresLista = null;
        if($fornecedores != null){
            foreach($fornecedores as $fornecedor){
                $fornecedoresLista .= "
                    <option>$fornecedor->razaoSocial</option><br/>
                ";
            }
        }

        $empresas = new Empresas_Model();
        $empresas = $empresas->list();
        $empresasLista = null;
        if($empresas != null){
            foreach($empresas as $empresa){
                $empresasLista .= "
                    <option>$empresa->razaoSocial</option><br/>
                ";
            }
        }

        $this->render("boletos", [
            "fornecedores" => $fornecedoresLista,
            "empresas" => $empresasLista
        ]);
    }

    public function cadastrar(){
        $dados = (object) $_POST;

        $model = new Boletos_Model();

        //VERIFICA SE CODIGO DE BARRAS JÁ ESTÁ CADASTRADO
        $verificaCodigoBarras = $model->verificaCodigoBarras($dados->codigoBarrasCadastro);
        if($verificaCodigoBarras > 0):
            Alert::error("Código de Barras já está cadastrado!", "Verifique os dados e tente novamente.", "/boletos");
            exit();
        endif;

        //VERIFICA SE FORNECEDOR EXISTE
        $modelFornecedor = new Fornecedor_Model();
        $retornoFornecedor = $modelFornecedor->verificaExisteRazao($dados->fornecedorCadastro);
        if($retornoFornecedor == false){
            Alert::error("Fornecedor não encontrado na base de dados!", "Verifique os dados e tente novamente.", "/boletos");
            exit();
        }else{
            $dadosFornecedor = $modelFornecedor->dadosRazao($dados->fornecedorCadastro);
            $dados->fornecedorCadastro = $dadosFornecedor->id;
        }

        //VERIFICA SE EMPRESA EXISTE
        $modelEmpresa = new Empresas_Model();
        $retornoEmpresa = $modelEmpresa->verificaExisteRazao($dados->empresaCadastro);
        if($retornoEmpresa == false){
            Alert::error("Empresa não encontrada na base de dados!", "Verifique os dados e tente novamente.", "/boletos");
            exit();
        }else{
            $dadosEmpresa = $modelEmpresa->dadosRazao($dados->empresaCadastro);
            $dados->empresaCadastro = $dadosEmpresa->id;
        }

        $dados->valorCadastro = str_replace(".", "", $dados->valorCadastro);
        $dados->valorCadastro = str_replace(",", ".", $dados->valorCadastro);
        $dados->valorCadastro = (float) $dados->valorCadastro;

        //CADASTRA O BOLETO NO BANCO DE DADOS
        $cadastro = $model->cadastrar((array)$dados);

        if($cadastro["status"] === false){
            $cadastro["erro"] = str_replace("'", "", $cadastro["erro"]);
            Alert::error("Erro ao processar requisição!", $cadastro['erro'], "/boletos");
        }else{
            parent::log("BOLETO CADASTRADO | ID: ".$cadastro["id"]);
            Alert::success("Boleto Cadastrado!", '', '/boletos');
        }
    }

    public function excluir(){
        $model = new Boletos_Model();
        echo json_encode($model->excluir($_POST["id"]));
    }

    public function baixar(){
        $boletos = new Boletos_Model();
        $_POST["valorBaixa"] = str_replace(".", "", $_POST["valorBaixa"]);
        $_POST["valorBaixa"] = str_replace(",", ".", $_POST["valorBaixa"]);
        $retorno = $boletos->baixar($_POST["idBoletoBaixa"], $_POST["valorBaixa"], $_POST["dataRecebimentoBaixa"]);
        if($retorno["status"] === false){
            $this->log("FALHOU AO BAIXAR BOLETO | ID: ".$_POST["idBoletoBaixa"]);
            Alert::error("Erro ao baixar boleto!", $retorno["erro"], "/boletos");
        }else{
            $this->log('BOLETO BAIXADO | ID: '.$_POST["idBoletoBaixa"]);
            Alert::success("Boleto Baixado!", '', '/boletos');
        }
    }

    public function barcode(){
        $boleto = new Boletos_Model();
        $dadosBoleto = $boleto->dadosID($_POST["id"]);
        unlink(__DIR__."/../../temp/barcode.svg");
        $barcode = new BarcodeGeneratorSVG();
        file_put_contents(__DIR__."/../../temp/barcode.svg", $barcode->getBarcode($dadosBoleto->codigoBarras, $barcode::TYPE_CODE_128, 3, 50));
        echo $dadosBoleto->codigoBarras;
    }

    public function estornar($data){
        $boleto = (new Boletos_Model())->findById($data["id"]);
        $boleto->valorPago = null;
        $boleto->dataPagamento = null;
        $boleto->save();
        if($boleto->fail()){
            Alert::error("Erro ao estornar!", $boleto->fail()->getMessage(), "/boletos");
        }else{
            $this->log("BAIXA ESTORNADA | ID: $data[id]");
            Alert::success("Baixa Estornada!", "", "/boletos");
        }
    }

    public function tabela(){
        $boletos = new Boletos_Model();
        $boletos = $boletos->lista();
        if($boletos !== null){
            foreach($boletos as $boleto){
                $acoes = null;
                //PEGA OS DADOS DO FORNECEDOR
                $fornecedor = new Fornecedor_Model();
                $fornecedor = $fornecedor->dadosID($boleto->fornecedor);

                //PEGA OS DADOS DA EMPRESA
                $empresa = new Empresas_Model();
                $empresa = $empresa->dadosID($boleto->empresa);

                if($boleto->valorPago == null){
                    $boleto->valorPago = 0;
                }

                $acoes .= "<a href='javascript:void(0)' onclick='barcode($boleto->id)'><img id='barcode' src='/assets/images/barcode.png' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-custom-class='custom-tooltip' title='Código de Barras' class='imagem-acao'></a>";

                if($boleto->dataPagamento == null){
                    $boleto->dataPagamento = "";
                    $acoes .= "<a href='javascript:void(0)' onclick='baixa($boleto->id)'><img id='receber' src='/assets/images/receber.png' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-custom-class='custom-tooltip' title='Dar Baixa' class='imagem-acao'></a>";
                    $acoes .= "<img id='estornar' style='-webkit-filter: grayscale(100%);' src='/assets/images/estornar.png' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-custom-class='custom-tooltip' title='Estornar Baixa' class='imagem-acao'>";
                    $acoes .= "<a href='javascript:void(0)' onclick='excluir($boleto->id)'><img id='excluir' src='/assets/images/excluir.png' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-custom-class='custom-tooltip' title='Excluir Boleto' class='imagem-acao'></a>";
                    if(strtotime($boleto->vencimento) > date('Y/m/d')){
                        $situacao = "<span style='font-weight: bold; color: black;'>À VENCER</span>";
                    }else{
                        $situacao = "<span style='font-weight: bold; color: red;'>VENCIDO</span>";
                    }
                }else{
                    $acoes .= "<img id='receber' style='-webkit-filter: grayscale(100%);' src='/assets/images/receber.png' title='Dar Baixa' class='imagem-acao'>";
                    $acoes .= "<a href='javascript:void(0)' onclick='estornar($boleto->id)'><img id='estornar' src='/assets/images/estornar.png' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-custom-class='custom-tooltip' title='Estornar Baixa' class='imagem-acao'></a>";
                    $acoes .= "<img id='excluir' style='-webkit-filter: grayscale(100%);' src='/assets/images/excluir.png' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-custom-class='custom-tooltip' title='Excluir Boleto' class='imagem-acao'>";
                    $situacao = "<span style='font-weight: bold; color: darkgreen;'>PAGO</span>";
                    $boleto->dataPagamento = date("d/m/Y", strtotime($boleto->dataPagamento));
                }

                $tabela["data"][] = [
                    $boleto->id,
                    $situacao,
                    $boleto->nfe,
                    $empresa->razaoSocial,
                    $fornecedor->razaoSocial,
                    'R$ '.number_format($boleto->valor, 2, ',', '.'),
                    date("d/m/Y", strtotime($boleto->vencimento)),
                    date("d/m/Y", strtotime($boleto->emissao)),
                    'R$ '.number_format($boleto->valorPago, 2, ',', '.'),
                    $boleto->dataPagamento,
                    $acoes
                ];
            }
        }else{
            $tabela["data"] = [];
        }

        echo json_encode($tabela);
    }


}