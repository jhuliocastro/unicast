<?php
namespace Controller;

class NFE extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        parent::render("nfe");
    }
}