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

//CLIENTES
$router->group("clientes");
$router->get("/cadastrar", "Clientes:cadastrar");
$router->post("/cadastrar", "Clientes:cadastrarSender");

//PRODUTOS
$router->group("produtos");
$router->post("/cadastrar", "Produtos:cadastrar");
$router->get("/relacao", "Produtos:relacao");
$router->get("/tabela", "Produtos:tabela");
$router->post("/dados", "Produtos:dados");
$router->post("/pesquisar/dados/id", "Produtos:dadosID");
$router->post("/pesquisar", "Produtos:pesquisa");
$router->get("/editar/{id}", "Produtos:editar");
$router->post("/editar", "Produtos:editarSender");
$router->post("/alterar/valor", "Produtos:alterarValor");

//ESTOQUE
$router->group("estoque");
$router->post("/entrada", "Estoque:entrada");
$router->post("/saida", "Estoque:saida");
$router->get("/atualizar", "Estoque:atualizar");

//PDV ORCAMENTO E CAIXA
$router->group("pdv");
$router->get("/caixa", "Caixa:home");
$router->post("/caixa/importar", "Caixa:importar");
$router->post("/caixa/valorTotal", "Caixa:valorTotal");
$router->get("/orcamento", "Orcamento:home");
$router->get("/orcamento/novo", "Orcamento:novo");
$router->post("/orcamento/andamento", "Orcamento:orcamento");
$router->get("/orcamento/aberto/{id}", "Orcamento:aberto");
$router->get("/orcamento/aberto/relacao/{id}", "Orcamento:abertoTabela");
$router->get("/orcamento/reabrir/cancelar", "Orcamento:cancelar");
$router->get("/orcamento/finalizar", "Orcamento:finalizar");
$router->get("/orcamento/finalizarSender", "Orcamento:finalizarSender");
$router->get("/orcamento/tabela", "Orcamento:tabela");
$router->post("/orcamento/dados", "Orcamento:dados");
$router->get("/orcamento/fechado/{id}", "Orcamento:fechado");
$router->get("/orcamento/excluir/{id}", "Orcamento:excluir");
$router->get("/orcamento/excluirSender/{id}", "Orcamento:excluirSender");
$router->post("/orcamento/excluir/produto", "Orcamento:excluirProduto");
$router->get("/orcamento/pdf/{id}", "Orcamento:exportarPDF");
$router->post("/caixa/pesquisar/produto", "Caixa:pesquisarProduto");
$router->post("/caixa/finalizar/dinheiro", "Caixa:finalizarDinheiro");
$router->get("/caixa/finalizar/dinheiro/true", "Caixa:trueDinheiro");
$router->get("/caixa/finalizar/dinheiro/false", "Caixa:falseDinheiro");
$router->post("/caixa/finalizar/cartao", "Caixa:finalizarCartao");
$router->post("/caixa/finalizar/pix", "Caixa:finalizarPIX");
$router->get("/imprimir/cupom", "Caixa:imprimirCupom");
$router->get("/imprimir/cupom/{orcamento}/{venda}", "Vendas:imprimirCupomID");

//VENDAS
$router->get("/vendas", "Vendas:home");
$router->get("/vendas/relacao", "Vendas:relacao");

//OBRAS
$router->group("/obras");
$router->get("/", "Obras:home");
$router->get("/relacao", "Obras:relacao");

//NFE
$router->group("nfe");
$router->get("/", "NFE:home");
$router->get("/manifestacao", "NFE:manifestacao");

//LOG
$router->group("log");
$router->get("/", "Log:relacao");

//CAIXA DIARIO
$router->group("caixaDiario");
$router->get("/", "CaixaDiario:home");
$router->get("/tabela", "CaixaDiario:tabela");
$router->get("/abrir", "CaixaDiario:abrir");
$router->post("/sangria", "CaixaDiario:sangria");
$router->post("/excluir", "CaixaDiario:excluir");
$router->get("/fechar", "CaixaDiario:fechar");
$router->get("/fechar/sender", "CaixaDiario:fecharSender");
$router->get("/cupom/sangria/{id}", "CaixaDiario:cupomSangria");

//EMPRESAS
$router->group("empresas");
$router->get("/", "Empresas:home");
$router->get("/tabela", "Empresas:tabela");

//RELATORIOS
$router->group("/relatorios");
$router->get("/caixaDiario", "Relatorios:caixaDiario");
$router->get("/caixaDiario/tabela", "CaixaDiario:relatorioDiario");
$router->get("/caixaDiario/imprimir/{id}", "Relatorios:imprimirCaixaDiario");

$router->dispatch();

if($router->error()){
    var_dump($router->error());
}