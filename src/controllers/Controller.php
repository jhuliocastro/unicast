<?php
namespace Controller;

use League\Plates\Engine;
use Model\Log_Model;
use Model\Login_Model;

class Controller{
    private $caminhoViews = __DIR__."/../views";

    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION["usuario"])){
            $this->router->redirect("/");
        }
    }

    public function permissoes($pagina){
        if(!isset($_SESSION))
        {
            session_start();
        }
        $retorno = false;
        $permissoes = file_get_contents(__DIR__."/../../permissoes.json");
        $permissoes = json_decode($permissoes);
        $permissoes = (array)$permissoes;
        foreach ($permissoes["$pagina"] as $permissoes){
            if($permissoes == $_SESSION["usuario"]){
                $retorno = true;
            }
        }

        if($retorno === false){
           $this->router->redirect("/erro/403");
        }
    }

    public function render($view, array $dados = []){
        if(isset($_SESSION["usuario"])){
            $usuarios = new Login_Model();
            $retornoUsuarios = $usuarios->dadosUsuarioAtivo();
            $dados["usuario"] = $retornoUsuarios->nomeCompleto;
        }
        $template = new Engine($this->caminhoViews);
        echo $template->render($view, $dados);
    }

    public function html($view, array $dados = []){
        if(isset($_SESSION["usuario"])){
            $usuarios = new Login_Model();
            $retornoUsuarios = $usuarios->dadosUsuarioAtivo();
            $dados["usuario"] = $retornoUsuarios->nomeCompleto;
        }
        $template = new Engine($this->caminhoViews);
        return $template->render($view, $dados);
    }

    public function log(string $evento){
        $ip = $_SERVER["REMOTE_ADDR"];
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION["usuario"])){
            $usuario = "";
        }else{
            $usuario = $_SESSION["usuario"];
        }        

        $log = new Log_Model();
        $log->cadastrar($evento, $ip, $usuario);
    }
}