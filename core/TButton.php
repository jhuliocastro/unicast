<?php
namespace Core;

class TButton{
    private $type;
    private $class;
    private $title;
    private $action;
    private $js = false;

    public function addTitle(string $title){
        $this->title = $title;
    }

    public function addAction(string $action){

    }
}