<?php

namespace Controller;

use Model\Clientes_Model;
use Model\Orcamentos_Model;
use Model\OrcamentosPedido_Model;
use Model\Produtos_Model;

class Caixa extends Controller
{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home()
    {
        $model = new Orcamentos_Model();
        $orcamentos = $model->listaNaoFaturados();
        $tabelaOrcamento = null;
        foreach ($orcamentos as $orcamento) {
            if ($orcamento->aberto == 0) {
                $modelCliente = new Clientes_Model();
                $cliente = $modelCliente->dadosClienteID($orcamento->cliente);
                $orcamento->cliente = $cliente->nome;

                $valor = number_format($orcamento->valor, 2, ",", ".");
                $tabelaOrcamento .= "
                <tr>
                    <td>$orcamento->id</td>
                    <td>$orcamento->cliente</td>
                    <td>R$ $valor</td>
                </tr>
            ";
            }
        }

        parent::render("caixa", [
            "orcamentos" => $tabelaOrcamento
        ]);
    }

    public function valorTotal(){
        $model = new Orcamentos_Model();
        $dados = $model->dadosID($_POST["orcamento"]);
        $dados->valor = number_format($dados->valor, 2, ",", ".");
        echo $dados->valor;
    }

    public function importar()
    {
        $modelOrcamento = new Orcamentos_Model();
        $retorno = $modelOrcamento->verificaExiste($_POST["orcamento"]);
        if ($retorno > 0) {
            $model = new OrcamentosPedido_Model();
            $existe = $model->verificaExiste($_POST["orcamento"]);
            if ($existe > 0) {
                $produtos = $model->retornoProdutos($_POST["orcamento"]);
                $tabela = null;
                foreach ($produtos as $produto) {
                    $modelProduto = new Produtos_Model();
                    $dadosProduto = $modelProduto->retornoPorID($produto->produto);

                    $valorTotal = $dadosProduto->precoVenda * $produto->quantidade;
                    $valorTotal = number_format($valorTotal, 2, ",", ".");
                    $valorUN = number_format($dadosProduto->precoVenda, 2, ",", ".");

                    $tabela .= "
                        <tr>
                            <td>$dadosProduto->id</td>
                            <td>$dadosProduto->nome</td>
                            <td>$produto->quantidade</td>                    
                            <td>R$ $valorUN</td>
                            <td>R$ $valorTotal</td>
                        </tr>
                    ";
                }

                echo $tabela;
            } else {
                echo "em branco";
            }
        } else {
            echo "nao existe";
        }
    }
}