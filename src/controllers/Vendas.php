<?php

namespace Controller;

use Core\TPage;
use Core\TTable;
use Model\CaixaDiario_Model;
use Model\Clientes_Model;
use Model\OrcamentosPedido_Model;
use Model\Produtos_Model;
use Model\Vendas_Model;
use Model\Vendas_Produtos_Model;

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
        $modelVendas = new Vendas_Model();
        $dadosVenda = $modelVendas->dadosID($data["venda"]);

        $modelCliente = new Clientes_Model();
        $dadosCliente = $modelCliente->dadosClienteID($dadosVenda->cliente);

        $modelVendasProdutos = new Vendas_Produtos_Model();
        $produtos = $modelVendasProdutos->produtosVenda($data["venda"]);

        $dados = null;
        foreach ($produtos as $produto){
            $modelProduto = new Produtos_Model();
            $dadosProduto = $modelProduto->retornoPorID($produto->produto);

            $valorTotalProduto = $dadosProduto->precoVenda * $produto->quantidade;
            $valorTotalProduto = number_format($valorTotalProduto, 2, ",", ".");
            $dadosProduto->precoVenda = number_format($dadosProduto->precoVenda, 2, ",", '.');


            $dados .= "
            <div class='row'>
                <div class='col-12'>$dadosProduto->nome</div>
                <div class='col-6'>$produto->quantidade X R$ $dadosProduto->precoVenda | $dadosProduto->unidadeMedida</div>
                <div class='col-6' style='text-align: right;'>R$ $valorTotalProduto</div>
            </div>
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
            "numeroVenda" => $dadosVenda->id,
            "pix" => number_format($dadosVenda->pix, 2, ",", "."),
            "dinheiro" => number_format($dadosVenda->dinheiro, 2, ",", "."),
            "credito" => number_format($dadosVenda->credito, 2, ",", "."),
            "debito" => number_format($dadosVenda->debito, 2, ",", "."),
            "crediario" => number_format($dadosVenda->crediario, 2, ",", ".")
        ]);
    }

    public function estornar(){
        $model = new Vendas_Model();
        $dadosVenda = $model->dadosID($_POST["idVenda"]);
        if($dadosVenda->dinheiro == 0 || $dadosVenda->dinheiro == null){
            
        }else{
            $modelCaixa = new CaixaDiario_Model();
            $descricao = "VENDA ".$_POST["idVenda"];
            $retorno = $modelCaixa->excluirPorDescricao($descricao);
            if($retorno["status"] == false){
                echo json_encode($retorno);
                exit();
            }
        }
        $model = new Vendas_Model();
        $retorno = $model->excluir($_POST["idVenda"]);
        if($retorno["status"] == false){
            echo json_encode($retorno);
            exit();
        }else{
            $modelVendasProdutos = new Vendas_Produtos_Model();
            $produtos = $modelVendasProdutos->produtosVenda($_POST["idVenda"]);
            if($produtos != null){
                foreach($produtos as $produto){
                    $modelProduto = new Produtos_Model();
                    $dadosProduto = $modelProduto->retornoPorID($produto->produto);
                    $quantidadeNova = $dadosProduto->estoqueAtual + $produto->quantidade;
                    $retorno = $modelProduto->atualizarEstoque($dadosProduto->id, $quantidadeNova);
                    if($retorno["status"] == false){
                        echo json_encode($retorno);
                        exit();
                    }
                }
            }

            $retorno = [
                "status" => true
            ];
            echo json_encode($retorno);
        }
        
    }

    private static function nuloPara0($valor){
        if($valor == null){
            $valor = 0;
        }
        return $valor;
    }

    public function relacao()
    {
        $model = new Vendas_Model();
        $listaVendas = $model->lista();

        if($listaVendas != null){
            foreach ($listaVendas as $venda) {
                $modelCliente = new Clientes_Model();
                $dadosCliente = $modelCliente->dadosClienteID($venda->cliente);
                $opcoes = "<a data-bs-toggle='tooltip' data-bs-placement='top' data-bs-custom-class='custom-tooltip' title='Imprimir Cupom' onclick='cupom(\"$venda->id\");' href='#'><img class='imagem-acao' src='/assets/images/imprimir.png'></a>";
                $opcoes .= "<a data-bs-toggle='tooltip' data-bs-placement='top' data-bs-custom-class='custom-tooltip' title='Estornar Venda' onclick='estorno(\"$venda->id\");' href='javascript:void(0)'><img class='imagem-acao' src='/assets/images/estornar.png'></a>";

                $tabela["data"][] = [
                    $venda->id,
                    $dadosCliente->nome,
                    $venda->orcamento,
                    "R$ " . number_format($this->nuloPara0($venda->valorTotal), 2, ',', '.'),
                    "R$ " . number_format($this->nuloPara0($venda->valorPago), 2, ',', '.'),
                    "R$ " . number_format($this->nuloPara0($venda->desconto), 2, ',', '.'),
                    "R$ " . number_format($this->nuloPara0($venda->troco), 2, ',', '.'),
                    "R$ " . number_format($this->nuloPara0($venda->dinheiro), 2, ',', '.'),
                    "R$ " . number_format($this->nuloPara0($venda->credito), 2, ',', '.'),
                    "R$ " . number_format($this->nuloPara0($venda->debito), 2, ',', '.'),
                    "R$ " . number_format($this->nuloPara0($venda->crediario), 2, ',', '.'),
                    "R$ " . number_format($this->nuloPara0($venda->pix), 2, ',', '.'),
                    date("d/m/Y H:i:s", strtotime($venda->created_at)),
                    $opcoes
                ];
            }
        }else{
            $tabela["data"] = [];
        }

        echo json_encode($tabela);
    }
}