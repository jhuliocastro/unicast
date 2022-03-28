<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Vendas_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("obras", [], "id", true);
    }

    public function lista(){
        return $this->find()->fetch(true);
    }
}