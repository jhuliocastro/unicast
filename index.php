<?php
require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL);

$router->namespace("Controller");

$router->get("/", "Login:home");
$router->post("/login", "Login:login");

$router->dispatch();

if($router->error()){
    var_dump($router->error());
}