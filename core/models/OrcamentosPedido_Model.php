<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class OrcamentosPedido_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("orcamentos_pedidos", [], 'id', true);
    }

    public function cadastrar(int $orcamento, int $produto, int $quantidade){
        $this->orcamento = $orcamento;
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->save();
    }

    public function retornoProdutos(int $orcamento){
        return $this->find("orcamento=:orcamento", "orcamento=$orcamento")->order("id DESC")->fetch(true);
    }
}