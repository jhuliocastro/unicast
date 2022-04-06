<?php

namespace Controller;

use Alertas\Alert;
use Model\CaixaDiario_Model;
use Model\Clientes_Model;
use Model\Orcamentos_Model;
use Model\OrcamentosPedido_Model;
use Model\Produtos_Model;
use Model\Vendas_Model;

class Caixa extends Controller
{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home()
    {
        unset($_SESSION["caixaProdutos"]);
        unset($_SESSION["clienteCaixa"]);
        $_SESSION["clienteCaixa"] = 1;

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

        $model = new Produtos_Model();
        $produtos = $model->lista();
        $produtosLista = null;
        foreach($produtos as $produto){
            $produtosLista .= "
                <option>$produto->nome</option>
            ";
        }

        parent::render("caixa", [
            "orcamentos" => $tabelaOrcamento,
            "produtos" => $produtosLista
        ]);
    }

    public function pesquisarProduto(){
        $model = new Produtos_Model();
        $retorno = $model->verificaProdutoExiste($_POST["produto"]);
        if($retorno == 0){
            echo "nao existe";
        }else{
            $retorno = $model->retornaID($_POST["produto"]);
            echo $retorno->codigoBarras;
        }
    }

    public function valorTotal(){
        $model = new Orcamentos_Model();
        $dados = $model->dadosID($_POST["orcamento"]);
        $dados->valor = number_format($dados->valor, 2, ",", ".");
        echo $dados->valor;
    }

    public function importar()
    {
        if(isset($_SESSION["caixa"]["produtos"])){
            unset($_SESSION["caixa"]["produtos"]);
            unset($_SESSION["caixa"]);
        }

        $modelOrcamento = new Orcamentos_Model();
        $retorno = $modelOrcamento->verificaExiste($_POST["orcamento"]);

        $_SESSION["caixa"] = $_POST["orcamento"];

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

                    $_SESSION["caixaProdutos"][] = $dadosProduto->id;

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

    public function finalizarDinheiro(){
        $dados = (object)$_POST;

        $dados->valorPagoPedido = str_replace(",", ".", $dados->valorPagoPedido);
        $dados->valorPedido = str_replace(",", ".", $dados->valorPedido);

        $dados->troco = $dados->valorPagoPedido - ($dados->valorPedido - $dados->desconto);

        $model = new Vendas_Model();
        $retorno = $model->cadastrar($_SESSION["clienteCaixa"], $_SESSION["caixa"], $dados->valorPedido, $dados->troco, $dados->valorPagoPedido, "DINHEIRO", (float)$dados->desconto);

        $this->faturarOrcamento();

        if($retorno["status"] == true){
            $this->saidaProdutos();
            $this->gravaCaixaDiario($dados->valorPagoPedido, "VENDA Nº ".$_SESSION["caixa"], "Entrada");
            $retorno = [
                "status" => true
            ];
        }

        echo json_encode($retorno);
    }

    public function finalizarCartao(){
        $dados = (object)$_POST;

        $dados->valorPedido = str_replace(",", ".", $dados->valorPedido);

        switch ($dados->modoPagamento){
            case 'credito':
                $dados->modoPagamento = "CARTÃO DE CRÉDITO";
                break;
            case 'debito':
                $dados->modoPagamento = "CARTÃO DE DÉBITO";
                break;
        }

        $model = new Vendas_Model();
        $retorno = $model->cadastrar($_SESSION["clienteCaixa"], $_SESSION["caixa"], $dados->valorPedido, 0, $dados->valorPedido, $dados->modoPagamento, (float)$dados->desconto);

        $this->faturarOrcamento();

        if($retorno["status"] == true){
            $this->saidaProdutos();
            $retorno = [
                "status" => true
            ];
        }

        echo json_encode($retorno);
    }

    public function gravaCaixaDiario($valor, $descricao, $tipo){
        $caixaDiario = new CaixaDiario_Model();
        $retorno = $caixaDiario->inserir($valor, $descricao, $tipo);
    }

    private function faturarOrcamento(){
        $orcamento = $_SESSION["caixa"];
        $model = new Orcamentos_Model();
        $model->faturar($orcamento);
    }

    private function saidaProdutos(){
        $orcamento = $_SESSION["caixa"];
        $model = new OrcamentosPedido_Model();
        $produtos = $model->retornoProdutos($orcamento);
        foreach ($produtos as $produto){
            $modelProduto = new Produtos_Model();
            $dadosProduto = $modelProduto->retornoPorID($produto->produto);

            $quantidadeNova = $dadosProduto->estoqueAtual - $produto->quantidade;

            $modelProduto->atualizarEstoque($produto->produto, $quantidadeNova);
        }
    }

    public function trueDinheiro(){
        unset($_SESSION["clienteCaixa"]);
        unset($_SESSION["produtos"]);

        $model = new Vendas_Model();
        $retorno = $model->listaUltimo();

        $retorno->troco = number_format($retorno->troco, 2, ",", ".");

        parent::render("caixaTrue", [
            "troco" => $retorno->troco
        ]);
    }

    public function falseDinheiro(){
        Alert::error("Venda não concluída!", "Contate o suporte.", "/pdv/vendas/relacao");
    }

    public function imprimirCupom(){
        $model = new OrcamentosPedido_Model();
        $produtos = $model->retornoProdutos($_SESSION["caixa"]);

        $modelVendas = new Vendas_Model();
        $dadosVenda = $modelVendas->listaUltimo();

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

        $subTotal = $dadosVenda->valorTotal + $dadosVenda->desconto;
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
}