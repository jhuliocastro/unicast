<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class NFE_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("nfe", [], 'id', true);
    }

    /**
     * @param string $chave
     * @param int $destinario
     * @param int $emitente
     * @param float $valor
     * @param string $emissao
     * @return array
     */
    public function cadastrar(string $chave, int $destinario, int $emitente, float $valor, string $emissao){
        $this->chave = $chave;
        $this->empresa = $destinario;
        $this->fornecedor = $emitente;
        $this->valor = $valor;
        $this->emissao = $emissao;
        $this->save();

        if($this->fail()){
            $retorno = [
                "status" => false,
                "error" => $this->fail()->getMessage()
            ];
        }else{
            $retorno = [
                "status" => true,
                "id" => $this->id
            ];
        }

        return $retorno;
    }

    /**
     * @param string $chave
     * @return array
     */
    public function verificaExiste(string $chave){
        $retorno = $this->find("chave=:chave", "chave=$chave")->count();
        if($this->fail()){
            $retorno = [
                "status" => false,
                "error" => $this->fail()->getMessage()
            ];
        }else{
            if($retorno > 0){
                $retorno = [
                    "status" => true,
                    "existe" => true
                ];
            }else{
                $retorno = [
                    "status" => true,
                    "existe" => false
                ];
            }
        }

        return $retorno;
    }

    public function lista()
    {
        return $this->find()->fetch(true);
    }

    public function dados(int $id){
        return $this->findById($id);
    }
}