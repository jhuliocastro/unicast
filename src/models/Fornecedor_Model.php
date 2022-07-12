<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Fornecedor_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("fornecedor", [], 'id', true);
    }

    /**
     * @param object $dados
     * STRING - CNPJ<br/>
     * STRING - RAZAO SOCIAL<br/>
     * STRING - NOME FANTASIA<br/>
     * STRING - LOGRADOURO (NULL)<br/>
     * INT - NUMERO (NULL)<br/>
     * STRING - BAIRRO (NULL) <br/>
     * STRING - CIDADE (NULL)<br/>
     * STRING - ESTADO (NULL)<br/>
     * STRING - CEP (NULL)<br/>
     *
     * @return array
     */
        public function cadastrar(array $dados){
            $dados = (object) $dados;
        $this->cnpj = $dados->cnpj;
        $this->razaoSocial = $dados->razaoSocial;
        $this->nomeFantasia = $dados->nomeFantasia;
        $this->logradouro = $dados->logradouro;
        $this->numero = $dados->numero;
        $this->bairro = $dados->bairro;
        $this->cidade = $dados->cidade;
        $this->estado = $dados->estado;
        $this->cep = $dados->cep;
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
     * @param string $cnpj
     * @return array
     */
    public function verificaExiste(string $cnpj){
        $retorno = $this->find("cnpj=:cnpj", "cnpj=$cnpj")->count();
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

    public function dados(string $cnpj){
        return $this->find("cnpj=:cnpj", "cnpj=$cnpj")->fetch();
    }

    public function lista(){
        return $this->find()->order("razaoSocial ASC")->fetch(true);
    }
}