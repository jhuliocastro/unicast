<?php

namespace Controller;

use Model\Clientes_Model;
use Model\OrcamentosPedido_Model;
use Model\Produtos_Model;
use Model\Vendas_Model;

class Vendas extends Controller
{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home()
    {
        parent::render("vendas");
    }

    public function imprimirCupomID($data){
        $model = new OrcamentosPedido_Model();
        $produtos = $model->retornoProdutos($data["orcamento"]);

        $modelVendas = new Vendas_Model();
        $dadosVenda = $modelVendas->dadosID($data["venda"]);

        $modelCliente = new Clientes_Model();
        $dadosCliente = $modelCliente->dadosClienteID($dadosVenda->cliente);

        $dados = null;
        foreach ($produtos as $produto){
            $modelProduto = new Produtos_Model();
            $dadosProduto = $modelProduto->retornoPorID($produto->produto);

            $valorTotalProduto = $dadosProduto->precoVenda * $produto->quantidade;
            $valorTotalProduto = number_format($valorTotalProduto, 2, ",", ".");
            $dadosProduto->precoVenda = number_format($dadosProduto->precoVenda, 2, ",", '.');


            $dados .= "
            <tr class=\"top\">
                <td colspan=\"3\">$dadosProduto->nome</td>
            </tr>
            <tr>
                <td>R$ $dadosProduto->precoVenda</td>
                <td>$produto->quantidade</td>
                <td>R$ $valorTotalProduto</td>
            </tr>
            ";
        }

        $subTotal = $dadosVenda->valorTotal;
        $subTotal = number_format($subTotal, 2, ",", ".");

        $total = $dadosVenda->valorTotal - $dadosVenda->desconto;
        $total = number_format($total, 2, ",", ".");

        parent::render("cupom", [
            "produtos" => $dados,
            "cliente" => $dadosCliente->nome,
            "cpf" => $dadosCliente->cpf,
            "dataHora" => date("d/m/Y H:i:s", strtotime($dadosVenda->created_at)),
            "desconto" => number_format((float)$dadosVenda->desconto, 2, ",", "."),
            "subTotal" => $subTotal,
            "total" => $total,
            "modoPagamento" => $dadosVenda->formaPagamento,
            "troco" => number_format($dadosVenda->troco, 2, ",", "."),
            "valorPago" => number_format($dadosVenda->valorPago, 2, ",", "."),
            "numeroVenda" => $dadosVenda->id
        ]);
    }

    public function relacao()
    {
        $model = new Vendas_Model();
        $listaVendas = $model->lista();

        foreach ($listaVendas as $venda) {
            $modelCliente = new Clientes_Model();
            $dadosCliente = $modelCliente->dadosClienteID($venda->cliente);
            $opcoes = "<a data-role='hint' data-hint-text='Imprimir Cupom' onclick='cupom(\"$venda->orcamento\", \"$venda->id\");' href='#'><img class='imagem-acao' src='/assets/images/imprimir.png'></a>";
            $tabela["data"][] = [
                $venda->id,
                $dadosCliente->nome,
                $venda->orcamento,
                "R$ " . number_format($venda->valorTotal, 2, ',', '.'),
                "R$ " . number_format($venda->valorPago, 2, ',', '.'),
                "R$ " . number_format($venda->desconto, 2, ',', '.'),
                "R$ " . number_format($venda->troco, 2, ',', '.'),
                $venda->formaPagamento,
                date("d/m/Y H:i:s", strtotime($venda->created_at)),
                $opcoes
            ];
        }

        echo json_encode($tabela);
    }
}