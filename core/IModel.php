<?php
namespace Core;

interface IModel{
    public function register(array $data);
    public function edit(array $data);
    public function exclude(int $id);
    public function dataID(int $id);
    public function dataName(string $name);
    public function list();
}