<?php
namespace Controller;

use League\Plates\Engine;
use Model\Log;

class Controller{
    private $caminhoViews = __DIR__."/../views";

    public function __construct(){
        session_start();
        if(!isset($_SESSION["usuario"])){
            $this->router->redirect("/");
        }
    }

    public function render($view, array $dados = []){
        $template = new Engine($this->caminhoViews);
        echo $template->render($view, $dados);
    }

    public function log(string $evento){
        $ip = $_SERVER["REMOTE_ADDR"];
        $log = new Log();
        $log->cadastrar($evento, $ip);
    }
}