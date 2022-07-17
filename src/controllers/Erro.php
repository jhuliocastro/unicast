<?php
namespace Controller;

class Erro extends Controller {
    public function e403(){
        $this->render("403");
    }
}