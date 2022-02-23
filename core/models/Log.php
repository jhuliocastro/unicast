<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Log extends DataLayer{
    public function __construct()
    {
        parent::__construct("log", [], "id", true);
    }

    public function cadastrar(string $evento, string $ip){
        $this->evento = $evento;
        $this->ip = $ip;
        $this->save();
    }
}