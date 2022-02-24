<?php
namespace Controller;

use Alertas\Alert;
use Model\Produtos_Model;

class Produtos extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function cadastrar(){
        parent::render("produtosCadastrar");
    }

    public function cadastrarSender(){
        $dados = (object)$_POST;
        $dados->precoCompra = str_replace(",", ".", $dados->precoCompra);
        $dados->precoCompra = (float) $dados->precoCompra;
        $dados->precoVenda = str_replace(",", ".", $dados->precoCompra);
        $dados->precoVenda = (float) $dados->precoVenda;
        $dados->estoqueAtual = (int) $dados->estoqueAtual;
        $dados->estoqueMinimo = (int) $dados->estoqueMinimo;

        $produtos = new Produtos_Model();
        $retorno = $produtos->cadastrar($dados);

        if($retorno == false){
            parent::log("ERRO CADASTRO DE PRODUTOS");
            Alert::error("Erro ao cadastrar produto!", "Verifique o log para mais informações.", "/produtos/cadastrar");
        }else if($retorno == true){
            parent::log("PRODUTO CADASTRADO");
            Alert::success("Produto cadastrado com sucesso!", "", "/produtos/cadastrar");
        }
    }
}