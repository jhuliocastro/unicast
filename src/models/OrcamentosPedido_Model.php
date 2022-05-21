<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class OrcamentosPedido_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("orcamentos_pedidos", [], 'id', true);
    }

    public function cadastrar(int $orcamento, int $produto, int $quantidade){
        $this->orcamento = $orcamento;
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->save();
    }

    public function retornoProdutos(int $orcamento){
        return $this->find("orcamento=:orcamento", "orcamento=$orcamento")->order("id DESC")->fetch(true);
    }

    public function verificaExiste(int $orcamento){
        return $this->find("orcamento=:orcamento", "orcamento=$orcamento")->count();
    }

    public function excluir(int $orcamento){
        $model = $this->find("orcamento=:orc", "orc=$orcamento")->fetch();
        $model->destroy();
    }

    public function excluirProduto(int $produto, int $orcamento){
        $model = $this->find("orcamento=:orc AND produto=:produto", "orc=$orcamento&produto=$produto")->fetch(true);
        foreach($model as $produto){
            $excluir = ($this)->findById($produto->id);
            $excluir->destroy();
            if($excluir->fail()){
                $retorno = [
                    "status" => false,
                    "erro" => $excluir->fail()->getMessage()
                ];
                exit();
            }
        }

        $retorno = [
            "status" => true
        ];
        
        return $retorno;
    }

    public function verificaExisteExcluirProduto(int $produto, int $orcamento){
        $this->find("produto=:produto AND orcamento=:orcamento", "produto=$produto&orcamento=$orcamento")->count();
        if($this->fail()){
            $retorno = [
                "status" => false,
                "erro" => $this->fail()->getMessage()
            ];
        }else{
            $retorno = ["status"=>true];
        }

        return $retorno;
    }
}