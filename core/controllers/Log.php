<?php
namespace Controller;

use Model\Log_Model;

class Log extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function relacao(){
        $logModel = new Log_Model();
        $dados = $logModel->relacao();
        //var_dump($dados);

        $tabela = null;
        foreach($dados as $d){
            $tabela .= "
                <tr>
                    <td>$d->id</td>
                    <td>$d->evento</td>
                    <td>$d->usuario</td>
                    <td>$d->ip</td>
                    <td>$d->created_at</td>                   
                </tr>
            ";
        }

        parent::render("log", [
            "tabela" => $tabela
        ]);
    }
}