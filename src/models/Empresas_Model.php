<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Empresas_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("empresas", [], "id", true);
    }

    public function lista(){
        return $this->find()->fetch(true);
    }
}