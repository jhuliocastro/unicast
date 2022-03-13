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

$router->group("clientes");
$router->get("/cadastrar", "Clientes:cadastrar");
$router->post("/cadastrar", "Clientes:cadastrarSender");

$router->group("produtos");
$router->get("/cadastrar", "Produtos:cadastrar");
$router->post("/cadastrar", "Produtos:cadastrarSender");
$router->get("/relacao", "Produtos:relacao");
$router->get("/tabela", "Produtos:tabela");
$router->post("/dados", "Produtos:dados");
$router->post("/pesquisar", "Produtos:pesquisa");

$router->group("estoque");
$router->get("/entrada", "Estoque:entrada");
$router->post("/entrada", "Estoque:entradaSender");
$router->get("/relacao", "Estoque:relacao");
$router->get("/lista", "Estoque:tabela");

$router->group("pdv");
$router->get("/caixa", "Caixa:home");
$router->get("/orcamento", "Orcamento:home");
$router->get("/orcamento/novo", "Orcamento:novo");
$router->post("/orcamento/andamento", "Orcamento:orcamento");
$router->get("/orcamento/aberto/{id}", "Orcamento:aberto");
$router->get("/orcamento/reabrir/cancelar", "Orcamento:cancelar");
$router->get("/orcamento/finalizar", "Orcamento:finalizar");
$router->get("/orcamento/finalizarSender", "Orcamento:finalizarSender");
$router->get("/orcamento/tabela", "Orcamento:tabela");

$router->group("log");
$router->get("/", "Log:relacao");

$router->dispatch();

if($router->error()){
    var_dump($router->error());
}