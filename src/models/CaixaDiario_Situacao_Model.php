<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class CaixaDiario_Situacao_Model extends DataLayer{
    public function __construct(){
        parent::__construct("caixa_situacao", [], "id", true);
    }

    public function dadosData($data){
        return $this->find("dataCaixa=:data", "data=$data")->count();
    }

    public function dadosID(int $id){
        return $this->findById($id);
    }

    public function dados($data){
        return $this->find("dataCaixa=:data", "data=$data")->fetch();
    }

    public function dadosUltimo(){
        return $this->find()->order("id DESC")->fetch();
    }

    public function salvar(){
        $this->dataCaixa = date("Y-m-d");
        $this->situacao = "ABERTO";
        return $this->save();
    }

    public function fechar(){
        $data = date("Y-m-d");
        $dados = $this->find("dataCaixa=:data", "data=$data")->fetch();
        $query = $this->findById($dados->id);
        $query->situacao = "FECHADO";
        return $query->save();
    }

    public function lista(){
        return $this->find()->fetch(true);
    }
}