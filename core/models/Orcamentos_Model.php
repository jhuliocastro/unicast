<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Orcamentos_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("orcamentos", [], "id", true);
    }

    public function pesquisaStatus(){
        return $this->find("aberto=:status", "status=1")->count();
    }

    public function lista(){
        return $this->find()->order("id DESC")->fetch(true);
    }

    public function novo(int $cliente){
        $this->cliente = $cliente;
        $this->aberto = true;
        $this->valor = 0.00;
        return $this->save();
    }

    public function atualizarValor(int $orcamento, $valor){
        $retorno = $this->findById($orcamento);
        $retorno->valor = $valor;
        $retorno->save();
    }

    public function abertos(){
        return $this->find("aberto=:status", "status=1")->fetch();
    }

    public function dadosID(int $id){
        return $this->findById($id);
    }

    public function cancelarAbertos(){
        $orcamento = $this->find("aberto=:aberto", "aberto=1")->fetch();
        $orcamento->aberto = 0;
        return $orcamento->save();
    }

    public function finalizar(int $id){
        $orcamento = $this->findById($id);
        $orcamento->aberto = 0;
        return $orcamento->save();
    }
}