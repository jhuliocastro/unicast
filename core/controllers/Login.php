<?php
namespace Controller;

use Alertas\Alert;
use Model\Login_Model;

class Login extends Controller{

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function home(){
        parent::render("login");
    }

    public function login(){
        $usuario = $_POST["usuario"];
        $senha = md5($_POST["senha"]); //CRIPTOGRAFIA MD5 PARA SENHA
        $loginBanco = new Login_Model();
        $retorno = $loginBanco->confereDados($usuario, $senha); //CONFERE SE OS DADOS EXISTEM NO BANCO DE DADOS
        if($retorno > 0){
            session_start();
            $_SESSION["usuario"] = $usuario;
            parent::log("USUÁRIO $usuario LOGADO");
            $this->router->redirect("/dashboard");
        }else{
            parent::log("ERRO LOGIN");
            Alert::error("Usuário ou senha incorretos!", "Verifique os dados e tente novamente.", "/");
        }
    }
}