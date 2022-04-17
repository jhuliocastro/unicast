<?php
namespace Core;

class Ctables{
    public $titulo;
    private $colunas;
    private $buttons;

    public function __construct()
    {
       
    }

    public function addTitulo(string $titulo){
        $this->titulo = $titulo;
    }

    public function addColumn(string $coluna){
        $this->colunas .= "
            <td>$coluna</td>
        ";
    }

    public function addButtons(string $title, string $action, string $icon, string $shortcut, string $class = "primary"){
        $this->buttons .= "
        <button type='button' class='shortcut $class' id='botaoNovoOrcamento'>
            <span class=\"badge\">$shortcut</span>
            <span class=\"caption\">$title</span>
            <span class=\"mif-$icon icon\"></span>
        </button>
        ";
    }

    public function addActions(){
        
    }
}