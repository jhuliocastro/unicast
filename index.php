<?php
require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL);

$router->namespace("Controller");

$router->get("/", "Login:home");
$router->post("/login", "Login:login");
$router->get("/sair", "Login:sair");

$router->group("dashboard");
$router->get("/", "Dashboard:home");

$router->group("produtos");
$router->get("/cadastrar", "Produtos:cadastrar");
$router->post("/cadastrar", "Produtos:cadastrarSender");
$router->get("/relacao", "Produtos:relacao");
$router->get("/tabela", "Produtos:tabela");

$router->group("estoque");
$router->get("/entrada", "Estoque:entrada");
$router->post("/entrada", "Estoque:entradaSender");
$router->get("/relacao", "Estoque:relacao");
$router->get("/lista", "Estoque:tabela");

$router->group("log");
$router->get("/", "Log:relacao");

$router->dispatch();

if($router->error()){
    var_dump($router->error());
}