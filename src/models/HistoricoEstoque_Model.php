<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class HistoricoEstoque_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("historico_estoque", [], "id", true);
    }

    public function cadastrar(int $acao, int $produto, int $quantidade){
        $this->acao = $acao;
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->save();

        if($this->fail()){
            $retorno = [
                "status" => false,
                "erro" => $this->fail()->getMessage()
            ];
        }else{
            $retorno = ["status" => true];
        }

        return $retorno;
    }
}