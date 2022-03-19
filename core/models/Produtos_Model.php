<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;
use Controller\Controller;

class Produtos_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("produtos", [],'id', true);
    }

    public function cadastrar($dados){
        $this->nome = $dados->nome;
        $this->descricao = $dados->descricao;
        $this->precoVenda = $dados->precoVenda;
        $this->precoCompra = $dados->precoCompra;
        $this->unidadeMedida = $dados->unidadeMedida;
        $this->estoqueMinimo = $dados->estoqueMinimo;
        $this->estoqueAtual = $dados->estoqueAtual;
        $this->codigoBarras = $dados->codigoBarras;
        $retorno = $this->save();
        if($this->fail()){
            $controller = new Controller();
            $controller->log($this->fail()->getMessage());
        }
        return $retorno;
    }

    public function editar($dados){
        $produto = $this->findById($dados->id);
        $produto->nome = $dados->nome;
        $produto->descricao = $dados->descricao;
        $produto->precoVenda = $dados->precoVenda;
        $produto->precoCompra = $dados->precoCompra;
        $produto->unidadeMedida = $dados->unidadeMedida;
        $produto->estoqueMinimo = $dados->estoqueMinimo;
        $produto->estoqueAtual = $dados->estoqueAtual;
        $produto->codigoBarras = $dados->codigoBarras;
        $retorno = $produto->save();
        if($produto->fail()){
            $controller = new Controller();
            $controller->log($this->fail()->getMessage());
        }
        return $retorno;
    }

    public function lista(){
        return $this->find()->fetch(true);
    }

    public function verificaProdutoExiste($produto){
        return $this->find("nome=:nome", "nome=$produto")->count();
    }

    public function retornaID(string $produto){
        return $this->find("nome=:produto", "produto=$produto")->fetch();
    }

    public function retornoPorID(int $id){
        return $this->findById($id);
    }

    public function dadosCodigoBarras(string $codigoBarras){
        return $this->find("codigoBarras=:codigoBarras", "codigoBarras=$codigoBarras")->fetch();
    }

    public function atualizarEstoque(int $produto, int $quantidade){
        $atualizar = $this->findById($produto);
        $atualizar->estoqueAtual = $quantidade;
        $atualizar->save();
    }
}