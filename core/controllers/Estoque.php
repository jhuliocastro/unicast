<?php
namespace Controller;

use Model\HistoricoEstoque_Model;
use Model\Produtos_Model;
use Alertas\Alert;

class Estoque extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function relacao(){
        parent::render("estoqueRelacao");
    }

    public function tabela(){
        $produtos = new Produtos_Model();
        $listaProdutos = $produtos->lista();
        foreach($listaProdutos as $produto){
            $acoes = "
                <a href='#' onclick='entradaEstoque($produto->id)'><img src='/assets/images/entradaEstoque.png' class='imagem-acao'></a>
                <a href='#' onclick='saidaEstoque($produto->id)'><img id='saidaEstoque' src='/assets/images/saidaEstoque.png' class='imagem-acao'></a>
            ";
            if($produto->estoqueAtual == 0){
                $tabela["data"][] = [
                    "<span style='color: red;'>$produto->id</span>",
                    "<span style='color: red;'>$produto->nome</span>",
                    "<span style='color: red;'>$produto->estoqueAtual</span>",
                    $acoes
                ];
            }else{
                $tabela["data"][] = [
                    $produto->id,
                    $produto->nome,
                    $produto->estoqueAtual,
                    $acoes
                ];
            }
        }
        echo json_encode($tabela);
    }

    public function saida(){
        $dados = (object)$_POST;

        if($dados->quantidadeSaida == 0 || $dados->quantidadeSaida == null){
            Alert::warning("Não é permitido valor nulo.", "Verifique e tente novamente!", "/estoque/relacao");
            exit();
        }

        $produtosModel = new Produtos_Model();
        $retorno = $produtosModel->retornoPorID($dados->idQuantidadeSaida);

        $nomeProduto = $retorno->nome;
        $dados->quantidadeSaida = (int)$dados->quantidadeSaida;

        if($dados->quantidadeSaida > $retorno->estoqueAtual){
            Alert::error("Quantidade não pode ser maior que o estoque atual!", "", "/estoque/relacao");
            exit();
        }

        $quantidade = $retorno->estoqueAtual - $dados->quantidadeSaida;

        $produtosModel->atualizarEstoque($dados->idQuantidadeSaida, $quantidade);

        $historicoModel = new HistoricoEstoque_Model();
        $retorno = $historicoModel->cadastrar(0, $dados->idQuantidadeSaida, $quantidade);

        if($retorno == false){
            parent::log("ERRO");
            Alert::error("Erro ao cadastrar estoque!", "Verifique o log para mais informações.", "/estoque/relacao");
        }else if($retorno == true){
            parent::log("ESTOQUE CADASTRADO");
            Alert::success("Saída Estoque Efetuada!", $nomeProduto, "/estoque/relacao");
        }
    }

    public function entrada(){
        $dados = (object)$_POST;
        $produtosModel = new Produtos_Model();
        $retorno = $produtosModel->retornoPorID($dados->idQuantidadeEntrada);
        $produto = $retorno->id;

        $quantidade = $dados->quantidadeEntrada+ $retorno->estoqueAtual;

        $produtosModel->atualizarEstoque($produto, $quantidade);

        $historicoModel = new HistoricoEstoque_Model();
        $retorno = $historicoModel->cadastrar(1, $produto, $dados->quantidadeEntrada);

        if($retorno == false){
            parent::log("ERRO");
            Alert::error("Erro ao cadastrar estoque!", "Verifique o log para mais informações.", "/estoque/relacao");
        }else if($retorno == true){
            parent::log("ESTOQUE CADASTRADO");
            Alert::success("Entrada Estoque Efetuada!", "", "/estoque/relacao");
        }
    }

}