<?php
namespace Controller;

use Core\TPage;
use Core\TTable;
use Model\CaixaDiario_Model;
use Model\CaixaDiario_Situacao_Model;

class Relatorios extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function caixaDiario(){
        //parent::render("caixaDiarioRelatorio");
        $page = new TPage(0);

        $table = new TTable();
        $table->method("get");
        $table->header("Relatório Caixa Diário");
        $table->addColumn("id", "ID", "10%");
        $table->addColumn("data", "Data", "45%");
        $table->addColumn("valor", "Valor", "45%");
        $table->addColumn("opcoes", "", "10%");
        $table->url('/relatorios/caixaDiario/tabela');
        $table->addSearch("date", "data", "Data");

        $page->addTable($table->close());
        $page->addJS('caixaDiario');
        $page->show();
    }

    public function imprimirCaixaDiario($data){
        $tabela = null;
        $valorEntrada = 0;
        $valorSaida = 0;

        $model = new CaixaDiario_Situacao_Model();
        $dadosCaixa = $model->dadosID($data["id"]);

        $model = new CaixaDiario_Model();
        $retorno = $model->lista();
        foreach($retorno as $r){
            if(date("Y-m-d", strtotime($r->created_at)) == date("Y-m-d", strtotime($dadosCaixa->dataCaixa))){
                $tabela .= "
                    <tr>
                        <td colspan='2'>$r->descricao</td>
                        <td>R$ ".number_format((float)$r->valor, 2, ",", ".")."</td>
                    </tr>
                ";
                if($r->tipo == "Entrada"){
                    $valorEntrada = $valorEntrada + $r->valor;
                }else{
                    $valorSaida = $valorSaida + $r->valor;
                }

            }
        }

        $valorEntrada = number_format($valorEntrada, 2, ",", ".");
        $valorSaida = number_format($valorSaida, 2, ",", ".");

        $saldo = $model->saldoDia($dadosCaixa->dataCaixa);
        $saldo = number_format($saldo, 2, ",", ".");

        parent::render("cupomCaixaDiario", [
            "linhas" => $tabela,
            "data" => date("d/m/Y", strtotime($r->created_at)),
            "totalEntrada" => $valorEntrada,
            "totalSaida" => $valorSaida,
            "saldo" => $saldo
        ]);
    }
}