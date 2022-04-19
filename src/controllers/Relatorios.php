<?php
namespace Controller;

use Model\CaixaDiario_Model;
use Model\CaixaDiario_Situacao_Model;

class Relatorios extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function caixaDiario(){
        parent::render("caixaDiarioRelatorio");
    }

    public function imprimirCaixaDiario($data){
        $tabela = null;
        $valor = 0;

        $model = new CaixaDiario_Situacao_Model();
        $dadosCaixa = $model->dadosID($data["id"]);

        $model = new CaixaDiario_Model();
        $retorno = $model->lista();
        foreach($retorno as $r){
            if(date("Y-m-d", strtotime($r->created_at)) == date("Y-m-d", strtotime($dadosCaixa->dataCaixa))){
                $tabela .= "
                    <tr>
                        <td colspan='2'>$r->descricao</td>
                        <td>R$ $r->valor</td>
                    </tr>
                ";
                $valor = $valor + $r->valor;
            }
        }

        $valor = number_format($valor, 2, ",", ".");

        $saldo = $model->saldoDia($dadosCaixa->dataCaixa);
        $saldo = number_format($saldo, 2, ",", ".");

        parent::render("cupomCaixaDiario", [
            "linhas" => $tabela,
            "data" => date("d/m/Y", strtotime($r->created_at)),
            "valor" => $valor,
            "saldo" => $saldo
        ]);
    }
}