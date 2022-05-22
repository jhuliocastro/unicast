<?php
namespace Core;

interface IPage{
    public function addTable(string $table);
    public function addForm(string $form);
    public function addButton($botao);
    public function addJS(string $file);
    public function close();
}