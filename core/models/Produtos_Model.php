<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;
use Controller\Controller;

class Produtos_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("produtos", [],'id', true);
    }

    public function cadastrar($dados){
        $this->nome = $dados->nome;
        $this->descricao = $dados->descricao;
        $this->precoVenda = $dados->precoVenda;
        $this->precoCompra = $dados->precoCompra;
        $this->unidadeMedida = $dados->unidadeMedida;
        $this->estoqueMinimo = $dados->estoqueMinimo;
        $this->estoqueAtual = $dados->estoqueAtual;
        $retorno = $this->save();
        if($this->fail()){
            $controller = new Controller();
            $controller->log($this->fail()->getMessage());
        }
        return $retorno;
    }
}