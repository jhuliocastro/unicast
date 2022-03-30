<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class CaixaDiario_Model extends DataLayer{
    public function __construct(){
        parent::__construct("caixa", [], "id", true);
    }

    public function inserir($valor, $descricao, $tipo){
        $this->valor = $valor;
        $this->descricao = $descricao;
        $this->tipo = $tipo;
        return $this->save();
    }

    public function saldoDia($dia){
        $saldo = 0;
        $retorno = $this->find()->fetch(true);
        foreach($retorno as $dados){
            if(date("Y-m-d", strtotime($dados->created_at)) == $dia){
                $dados->valor = str_replace(",", ".", $dados->valor);
                if($dados->tipo == "Entrada"){
                    $saldo = $saldo + $dados->valor;
                }else{
                    $saldo = $saldo - $dados->valor;
                }
            }
        }
        return $saldo;
    }
}