<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;
use Core\IModel;

class Empresas_Model extends DataLayer implements IModel {
    public function __construct()
    {
        parent::__construct("empresas", [], "id", true);
    }

    /**
     * @param array $data
     * @return array
     */
    public function register(array $data):array
    {
        $data = (object) $data;
        $this->cnpj = $data->cnpj;
        $this->razaoSocial = $data->razaoSocial;
        $this->nomeFantasia = $data->nomeFantasia;
        $this->logradouro = $data->logradouro;
        $this->numero = $data->numero;
        $this->bairro = $data->bairro;
        $this->cidade = $data->cidade;
        $this->estado = $data->estado;
        $this->cep = $data->cep;
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
     * @param array $data
     * @return mixed
     */
    public function edit(array $data)
    {
        // TODO: Implement edit() method.
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function exclude(int $id)
    {
        // TODO: Implement exclude() method.
    }

    /**
     * @return mixed
     */
    public function list()
    {
        // TODO: Implement list() method.
        return $this->find()->order("razaoSocial ASC")->fetch(true);
    }

    public function dadosID(int $id){
        return $this->findById($id);
    }

    /**
     * @param array $column
     * @return array
     */
    public function listColumn(string $column): array
    {
        // TODO: Implement listColumn() method.
        $dados = null;
        return $this->find(null, null, $column)->fetch(true);
    }

    public function verificaExisteRazao(string $razaoSocial) : bool{
        $retorno = $this->find("razaoSocial=:razao", "razao=$razaoSocial")->count();
        if($retorno == 0){
            return false;
        }else{
            return true;
        }
    }

    public function dadosRazao(string $razaoSocial){
        return $this->find("razaoSocial=:razao", "razao=$razaoSocial")->fetch();
    }

    public function checkExist($column, $data)
    {
        $retorno = $this->find("$column=:$column", "$column=$data")->count();
        if($this->fail()){
            $retorno = [
                "status" => false,
                "error" => $this->fail()->getMessage()
            ];
        }else{
            if($retorno > 0){
                $retorno = [
                    "status" => true,
                    "exist" => true
                ];
            }else{
                $retorno = [
                    "status" => true,
                    "exist" => false
                ];
            }
        }

        return $retorno;
    }

    public function search($column, $data)
    {
        return $this->find("$column=:$column", "$column=$data")->fetch();
    }

    public function dados(string $cnpj){
        return $this->find("cnpj=:cnpj", "cnpj=$cnpj")->fetch();
    }
}