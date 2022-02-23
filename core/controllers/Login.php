<?php
namespace Controller;

class Login extends Controller{

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function home(){
        parent::render("login");
    }
}