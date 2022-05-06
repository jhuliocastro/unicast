<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Vendas_Produtos_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("vendas_produtos", [], "id", true);
    }

    public function cadastrar(int $venda, int $produto, int $quantidade){
        $this->id_venda = $venda;
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->save();

        if($this->fail()){
            $retorno = [
                "status" => false,
                "error" => $this->fail()->getMessage()
            ];
        }else{
            $retorno = [
                "status" => true
            ];
        }

        return $retorno;
    }

    public function produtosVenda($id){
        return $this->find("id_venda=:id", "id=$id")->fetch(true);
    }
}