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

    public function entrada(){
        $produtosModel = new Produtos_Model();
        $produtos = $produtosModel->lista();
        $listaProdutos = null;
        foreach($produtos as $d){
            $listaProdutos .= "<option value='$d->nome'>";
        }
        parent::render("estoqueEntrada", [
            "produtos" => $listaProdutos
        ]);
    }

    public function entradaSender(){
        $dados = (object)$_POST;
        $produtosModel = new Produtos_Model();
        $retorno = $produtosModel->retornaID($dados->produto);
        $dados->produto = $retorno->id;

        $quantidade = $dados->quantidade + $retorno->estoqueAtual;

        $produtosModel->atualizarEstoque($dados->produto, $quantidade);

        $historicoModel = new HistoricoEstoque_Model();
        $retorno = $historicoModel->cadastrar(1, $dados->produto, $dados->quantidade);

        if($retorno == false){
            parent::log("ERRO");
            Alert::error("Erro ao cadastrar estoque!", "Verifique o log para mais informações.", "/estoque/entrada");
        }else if($retorno == true){
            parent::log("ESTOQUE CADASTRADO");
            Alert::success("Estoque cadastrado com sucesso!", "", "/estoque/entrada");
        }
    }

}