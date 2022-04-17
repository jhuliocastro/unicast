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
        $this->descricao = "";
        $this->precoVenda = $dados->precoVenda;
        $this->precoCompra = $dados->precoCompra;
        $this->unidadeMedida = $dados->unidadeMedida;
        $this->estoqueMinimo = 1;
        $this->estoqueAtual = 0;
        $this->codigoBarras = $dados->codigoBarras;
        $retorno = $this->save();
        if($this->fail()){
            $controller = new Controller();
            $controller->log($this->fail()->getMessage());
            $retorno = [
                "status" => false,
                "erro" => $this->fail()->getMessage()
            ];
        }else{
            $retorno = ["status"=>true];
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

    public function quantidadeTotal(){
        return $this->find()->count();
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

        if($atualizar->fail()){
            $retorno = [
                "status" => false,
                "erro" => $atualizar->fail()->getMessage()
            ];
        }else{
            $retorno = [
                "status" => true
            ];
        }

        return $retorno;
    }

    public function alterarValor(int $id, float $valorCompra, float $valorVenda){
        $model = $this->findById($id);
        $model->precoCompra = $valorCompra;
        $model->precoVenda = $valorVenda;
        $retorno = $model->save();
        
        if($model->fail()){
            $retorno = [
                "status" => false,
                "erro" => $model->fail()->getMessage()
            ];
        }else{
            $retorno = [
                "status" => true
            ];
        }

        return $retorno;
    }
}