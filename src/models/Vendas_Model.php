<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Vendas_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("vendas", [], "id", true);
    }

    public function cadastrar(int $cliente, int $orcamento, float $valorTotal, float $troco, float $valorPago, string $formaPagamento, float $desconto){
        $this->cliente = $cliente;
        $this->orcamento = $orcamento;
        $this->valorTotal = $valorTotal;
        $this->troco = $troco;
        $this->valorPago = $valorPago;
        $this->formaPagamento = $formaPagamento;
        $this->desconto = $desconto;
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

    public function listaUltimo(){
        return $this->find()->order("id DESC")->fetch();
    }

    public function lista(){
        return $this->find()->fetch(true);
    }

    public function dadosID($id){
        return $this->findById($id);
    }
}