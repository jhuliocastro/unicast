<?php
namespace Controller;

use Alertas\Alert;
use Model\Clientes_Model;

class Clientes extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function cadastrar(){
        parent::render("clientesCadastrar");
    }

    public function cadastrarSender(){
        $dados = (object) $_POST;
        $clientesModel = new Clientes_Model();
        $retorno = $clientesModel->cadastrar($dados);
        if($retorno == true){
            Alert::success("Cliente Cadastrado com Sucesso!", "", "/clientes/relacao");
        }else if($retorno == false){
            Alert::success("Erro ao cadastrar cliente!", "Consulte o log para mais informações.", "/clientes/relacao");
        }
    }
}