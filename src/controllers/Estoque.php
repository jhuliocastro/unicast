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
            $retorno = [
              "status" => false,
              "erro" => "Não é permitido valor nulo."
            ];
        }else{
            $produtosModel = new Produtos_Model();
            $retorno = $produtosModel->retornaID($dados->produto);
            $produto = $retorno->id;

            $nomeProduto = $retorno->nome;
            $dados->quantidadeSaida = (int)$dados->quantidadeSaida;

            if($dados->quantidadeSaida > $retorno->estoqueAtual){
                $retorno = [
                    "status" => false,
                    "erro" => "Quantidade não pode ser maior que o estoque atual!"
                ];
            }else{
                $quantidade = $retorno->estoqueAtual - $dados->quantidadeSaida;

                $retorno = $produtosModel->atualizarEstoque($produto, $quantidade);

                if($retorno["status"] == true){
                    $historicoModel = new HistoricoEstoque_Model();
                    $retorno = $historicoModel->cadastrar(0, $dados->quantidadeSaida, $quantidade);

                    if($retorno["status"] == true){
                        $retorno = [
                            "status" => true
                        ];
                    }
                }
            }
        }

        echo json_encode($retorno);
    }

    public function entrada(){
        $dados = (object)$_POST;
        $produtosModel = new Produtos_Model();
        $retorno = $produtosModel->retornaID($dados->produto);
        $produto = $retorno->id;

        $quantidade = $dados->quantidadeEntrada+ $retorno->estoqueAtual;

        $retorno = $produtosModel->atualizarEstoque($produto, $quantidade);

        if($retorno["status"] == true){
            $historicoModel = new HistoricoEstoque_Model();
            $retorno = $historicoModel->cadastrar(1, $produto, $dados->quantidadeEntrada);

            if($retorno["status"] == true){
                $retorno = [
                    "status" => true
                ];
            }
        }

        echo json_encode($retorno);
    }

}