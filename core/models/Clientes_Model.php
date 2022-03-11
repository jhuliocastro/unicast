<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;
use Controller\Log;

class Clientes_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("clientes", [], 'id', true);
    }

    public function cadastrar($dados){
        $this->nome = $dados->nomeCliente;
        $this->pessoaContato = $dados->pessoaContato;
        $this->sexo = $dados->sexo;
        $this->cep = $dados->cep;
        $this->uf = $dados->uf;
        $this->cidade = $dados->cidade;
        $this->bairro = $dados->bairro;
        $this->logradouro = $dados->logradouro;
        $this->numero = $dados->numero;
        $this->complemento = $dados->complemento;
        $this->cpf = $dados->cpf;
        $this->rg = $dados->rg;
        $this->telefone = $dados->telefone;
        $this->email = $dados->email;
        $retorno = $this->save();
        if($this->fail()){
            $log = new Log_Model();
            $log->cadastrar("ERRO AO CADASTRAR CLIENTE", "", "");
            $log->cadastrar($this->fail()->getMessage(), "", "");
        }

        return $retorno;
    }
}