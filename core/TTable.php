<?php
namespace Core;

class TTable{
    private string $table;
    private string $id;
    private string $column;
    private string $data;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->table = "
            <table id='tabela' class='display compact' style='width: 100%;'>
        ";

        $this->column = "
        <thead>
            <tr></tr>
        </thead>
        ";

        $this->data = "
        <tbody>
        </tbody>
        ";

    }

    public function addColumn(string $column){
        $column = "<td>$column</td></tr>";
        $this->column = str_replace("</tr>", $column, $this->column);
    }
}