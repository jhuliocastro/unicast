<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class NFE_Produtos_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("nfe_produtos", [], 'id', true);
    }

    /**
     * @param string $chave
     * @param int $destinario
     * @param int $emitente
     * @param float $valor
     * @param string $emissao
     * @return array
     */
    public function cadastrar(string $chave, string $produto, float $valor, string $codigoBarras, int $quantidade, string $unidade){
        $this->chave = $chave;
        $this->produto = $produto;
        $this->codigoBarras = $codigoBarras;
        $this->valor = $valor;
        $this->quantidade = $quantidade;
        $this->unidade = $unidade;
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
}