<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Log_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("log", [], "id", true);
    }

    public function cadastrar(string $evento, string $ip, string $usuaro){
        $this->evento = $evento;
        $this->ip = $ip;
        $this->save();
    }

    public function relacao(){
        return $this->find()->fetch(true);
    }
}