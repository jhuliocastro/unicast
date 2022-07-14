<?php
namespace Controller;

use Model\Boletos_Model;
use Model\Empresas_Model;
use Model\Fornecedor_Model;
use Alertas\Alert;

class Boletos extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
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

        parent::render("boletos", [
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

        if($cadastro["status"] == false){
            $cadastro["erro"] = str_replace("'", "", $cadastro["erro"]);
            Alert::error("Erro ao processar requisição!", $cadastro['erro'], "/boletos");
        }else{
            Alert::success("Boleto Cadastrado!", '', '/boletos');
        }
    }

    public function tabela(){
        $boletos = new Boletos_Model();
        $boletos = $boletos->lista();
        if($boletos != null){
            foreach($boletos as $boleto){
                //PEGA OS DADOS DO FORNECEDOR
                $fornecedor = new Fornecedor_Model();
                $fornecedor = $fornecedor->dadosID($boleto->fornecedor);

                //PEGA OS DADOS DA EMPRESA
                $empresa = new Empresas_Model();
                $empresa = $empresa->dadosID($boleto->empresa);

                if($boleto->valorPago == null){
                    $boleto->valorPago = 0;
                }

                if($boleto->dataPagamento == null){
                    $boleto->dataPagamento = "";
                    if(strtotime($boleto->vencimento) > date('Y/m/d')){
                        $situacao = "<span style='font-weight: bold; color: black;'>À VENCER</span>";
                    }else{
                        $situacao = "<span style='font-weight: bold; color: red;'>VENCIDO</span>";
                    }
                }else{
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
                    ""
                ];
            }
        }else{
            $tabela["data"] = [];
        }

        echo json_encode($tabela);
    }
}