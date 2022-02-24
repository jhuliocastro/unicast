<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

class Login_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("usuarios", [], 'id', true);
    }

    public function confereDados(string $usuario, string $senha) : int{
        return $this->find("usuario=:usuario AND senha=:senha", "usuario=$usuario&senha=$senha")->count();
    }

    public function dadosUsuarioAtivo(){
        session_start();
        $usuario = $_SESSION["usuario"];
        return $this->find("usuario=:usuario", "usuario=$usuario")->fetch();
    }
}