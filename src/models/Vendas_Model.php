<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Vendas_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("vendas", [], "id", true);
    }

    public function cadastrar(int $cliente, $orcamento, float $valorTotal, float $dinheiro, float $debito, float $credito, float $crediario, float $pix, float $troco, float $valorPago, float $desconto){
        $this->cliente = $cliente;
        $this->orcamento = $orcamento;
        $this->valorTotal = $valorTotal;
        $this->troco = $troco;
        $this->valorPago = $valorPago;
        $this->dinheiro = $dinheiro;
        $this->credito = $credito;
        $this->debito = $debito;
        $this->crediario = $crediario;
        $this->pix = $pix;
        $this->desconto = $desconto;
        $this->save();

        if($this->fail()){
            $retorno = [
                "status" => false,
                "error" => $this->fail()->getMessage()
            ];
        }else{
            $retorno = [
                "status" => true,
                "id" => $this->id
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

    public function excluir(int $id){
        $model = ($this)->findById($id);
        $model->destroy();
        if($model->fail()){
            $retorno = [
                "status" => false,
                "erro" => $model->fail()->getMessage()
            ];
        }else{
            $retorno = ["status"=>true];
        }
        return $retorno;
    }
}