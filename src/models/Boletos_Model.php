<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Boletos_Model extends DataLayer{
    public function __construct(){
        parent::__construct("boletos", [], "id", true);
    }

    public function lista(){
        return $this->find()->fetch(true);
    }

    public function cadastrar(array $dados){
        $this->documento = $dados["documentoCadastro"];
        $this->vencimento = $dados["dataVencimentoCadastro"];
        $this->fornecedor = $dados["fornecedorCadastro"];
        $this->empresa = $dados["empresaCadastro"];
        $this->codigoBarras = $dados["codigoBarrasCadastro"];
        $this->emissao = $dados["dataEmissaoCadastro"];
        $this->nfe = $dados["chaveNFECadastro"];
        $this->valor = $dados["valorCadastro"];
        $this->save();
        if($this->fail()):
            $retorno = [
                "status" => false,
                "erro" => $this->fail()->getMessage()
            ];
        else:
            $retorno["status"] = true;
        endif;

        return $retorno;
    }

    public function verificaCodigoBarras(string $codigo){
        return $this->find("codigoBarras=:codigo", "codigo=$codigo")->count();
    }

    public function excluir(int $id){
        $excluir = $this->findById($id);
        $excluir->destroy();
        if($excluir->fail()){
            $retorno = [
                "status" => false,
                "erro" => $excluir->fail()->getMessage()
            ];
        }else{
            $retorno["status"] = true;
        }

        return $retorno;
    }
}