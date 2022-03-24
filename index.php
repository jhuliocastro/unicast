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
$router->get("/editar/{id}", "Produtos:editar");
$router->post("/editar", "Produtos:editarSender");

$router->group("estoque");
$router->post("/entrada", "Estoque:entrada");
$router->post("/saida", "Estoque:saida");
$router->get("/relacao", "Estoque:relacao");
$router->get("/lista", "Estoque:tabela");
$router->get("/atualizar", "Estoque:atualizar");

$router->group("pdv");
$router->get("/caixa", "Caixa:home");
$router->post("/caixa/importar", "Caixa:importar");
$router->post("/caixa/valorTotal", "Caixa:valorTotal");
$router->get("/orcamento", "Orcamento:home");
$router->get("/orcamento/novo", "Orcamento:novo");
$router->post("/orcamento/andamento", "Orcamento:orcamento");
$router->get("/orcamento/aberto/{id}", "Orcamento:aberto");
$router->get("/orcamento/reabrir/cancelar", "Orcamento:cancelar");
$router->get("/orcamento/finalizar", "Orcamento:finalizar");
$router->get("/orcamento/finalizarSender", "Orcamento:finalizarSender");
$router->get("/orcamento/tabela", "Orcamento:tabela");
$router->post("/orcamento/dados", "Orcamento:dados");
$router->get("/orcamento/fechado/{id}", "Orcamento:fechado");
$router->post("/caixa/pesquisar/produto", "Caixa:pesquisarProduto");
$router->post("/caixa/finalizar/dinheiro", "Caixa:finalizarDinheiro");
$router->get("/caixa/finalizar/dinheiro/true", "Caixa:trueDinheiro");
$router->get("/caixa/finalizar/dinheiro/false", "Caixa:falseDinheiro");
$router->get("/imprimir/cupom", "Caixa:imprimirCupom");

$router->get("/vendas", "Vendas:home");
$router->get("/vendas/relacao", "Vendas:relacao");

$router->group("/obras");
$router->get("/", "Obras:home");
$router->get("/relacao", "Obras:relacao");

$router->group("nfe");
$router->get("/", "NFE:home");

$router->group("log");
$router->get("/", "Log:relacao");

$router->dispatch();

if($router->error()){
    var_dump($router->error());
}