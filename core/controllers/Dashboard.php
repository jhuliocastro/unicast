<?php
namespace Controller;

use Model\Produtos_Model;

class Dashboard extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        $model = new Produtos_Model();
        $quantidadeProdutos = $model->quantidadeTotal;
        parent::render("dashboard", [
            "totalProdutos" => $quantidadeProdutos
        ]);
    }
}