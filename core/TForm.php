<?php
namespace Core;

class TForm{
    private string $form;

    public function __construct(string $id, string $method)
    {
        $this->form = "
            <form method='$method' id='$id'>
        ";
    }

    public function addInput(string $input){
        $this->form .= $input;
    }

    public function close(){
        $this->form .= "</form>";
    }

    public function show(){
        return $this->form;
    }
}