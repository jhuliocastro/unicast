<?php
namespace Controller;

class Caixa extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        parent::render("caixa");
    }
}