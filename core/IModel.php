<?php
namespace Core;

interface IModel{
    public function register(array $data);
    public function edit(array $data);
    public function exclude(int $id);
    public function search($column, $data);
    public function list();
    public function listColumn(string $column);
    public function checkExist($column, $data);
}