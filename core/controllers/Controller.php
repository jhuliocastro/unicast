<?php
namespace Controller;

use League\Plates\Engine;

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
}