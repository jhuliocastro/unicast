<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Vendas_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("vendas", [], "id", true);
    }

    public function cadastrar(int $cliente, int $orcamento, float $valorTotal, float $desconto, float $troco, float $valorPago, string $formaPagamento){
        $this->cliente = $cliente;
        $this->orcamento = $orcamento;
        $this->desconto = $desconto;
        $this->valorTotal = $valorTotal;
        $this->troco = $troco;
        $this->valorPago = $valorPago;
        $this->formaPagamento = $formaPagamento;
        return $this->save();
    }

    public function listaUltimo(){
        return $this->find()->order("id DESC")->fetch();
    }

    public function lista(){
        return $this->find()->fetch(true);
    }
}