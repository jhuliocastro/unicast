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
        if($empresasLista != null){
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

        $verificaCodigoBarras = $model->verificaCodigoBarras($dados->codigoBarrasCadastro);
        if($verificaCodigoBarras == 0):
            Alert::error("Código de Barras já está cadastrado!", "Verifique os dados e tente novamente.", "/boletos");
            exit();
        endif;

        $cadastro = $model->cadastrar((array)$dados);

        if($cadastro["status"] == false){
            Alert::error("Erro ao processar requisição!", $cadastro["erro"], "/boletos");
        }else{
            Alert::success("Boleto Cadastrado!", '', '/boletos');
        }
    }
}