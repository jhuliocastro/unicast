<?php
namespace Controller;

use Model\Produtos_Model;

class Obras extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        parent::render("obras");
    }

    public function relacao(){
        $produtos = new Produtos_Model();
        $listaProdutos = $produtos->lista();
        foreach($listaProdutos as $produto){
            $acoes = "
                <a href='#' onclick='entradaEstoque($produto->id)'><img src='/assets/images/entradaEstoque.png' class='imagem-acao'></a>
                <a href='#' onclick='saidaEstoque($produto->id)'><img id='saidaEstoque' src='/assets/images/saidaEstoque.png' class='imagem-acao'></a>
            ";
            if($produto->estoqueAtual == 0){
                $tabela["data"][] = [
                    "<span style='color: red;'>$produto->id</span>",
                    "<span style='color: red;'>$produto->nome</span>",
                    "<span style='color: red;'>$produto->estoqueAtual</span>",
                    $acoes
                ];
            }else{
                $tabela["data"][] = [
                    $produto->id,
                    $produto->nome,
                    $produto->estoqueAtual,
                    $acoes
                ];
            }
        }
        echo json_encode($tabela);
    }
}