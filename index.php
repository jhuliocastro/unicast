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


//BOLETOS
$router->group("boletos");
$router->get("/", "Boletos:home");
$router->post("/cadastrar", "Boletos:cadastrar");
$router->get("/tabela", "Boletos:tabela");
$router->post("/excluir", "Boletos:excluir");
$router->post("/baixar", "Boletos:baixar");
$router->post("/barcode", "Boletos:barcode");
$router->get("/estornar/{id}", "Boletos:estornar");


//CLIENTES
$router->group("clientes");
$router->get("/cadastrar", "Clientes:cadastrar");
$router->post("/cadastrar", "Clientes:cadastrarSender");
$router->get("/relacao", "Clientes:relacao");
$router->get("/tabela", "Clientes:tabela");

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
$router->post("/excluir", "Produtos:excluir");

//ESTOQUE
$router->group("estoque");
$router->post("/entrada", "Estoque:entrada");
$router->post("/saida", "Estoque:saida");
$router->get("/atualizar", "Estoque:atualizar");

//ORCAMENTO
$router->group("orcamento");
$router->get("/", "Orcamento:home");
$router->get("/{id}", "Orcamento:orcamento");
$router->post("/novo", "Orcamento:novo");
$router->post("/pesquisar/produto", "Orcamento:pesquisarProduto");
$router->get("/tabela/produtos/{id}", "Orcamento:tabelaProdutos");
$router->get("/tabela", "Orcamento:tabela");
$router->post("/valorTotal", "Orcamento:valorTotal");

//PDV ORCAMENTO E CAIXA
$router->group("pdv");
$router->get("/caixa", "Caixa:home");
$router->post("/caixa/importar", "Caixa:importar");
$router->post("/caixa/valorTotal", "Caixa:valorTotal");
$router->post("/orcamento/andamento", "Orcamento:orcamento");
$router->get("/orcamento/aberto/{id}", "Orcamento:aberto");
$router->get("/orcamento/aberto/relacao/{id}", "Orcamento:abertoTabela");
$router->get("/orcamento/reabrir/cancelar", "Orcamento:cancelar");

$router->post("/orcamento/dados", "Orcamento:dados");
$router->get("/orcamento/fechado/{id}", "Orcamento:fechado");
$router->get("/orcamento/excluir/{id}", "Orcamento:excluir");
$router->get("/orcamento/excluirSender/{id}", "Orcamento:excluirSender");
$router->post("/orcamento/excluir/produto", "Orcamento:excluirProduto");
$router->get("/orcamento/pdf/{id}", "Orcamento:exportarPDF");
$router->post("/caixa/pesquisar/produto", "Caixa:pesquisarProduto");
$router->get("/caixa/finalizar/true/{id}", "Caixa:trueVenda");
$router->get("/caixa/finalizar/false", "Caixa:falseVenda");
$router->post("/caixa/pagamento", "Caixa:pagamento");
$router->get("/imprimir/cupom", "Caixa:imprimirCupom");
$router->get("/imprimir/cupom/{venda}", "Vendas:imprimirCupomID");
$router->post("/md5", "Caixa:json");
$router->post("/caixa/cancelar/item", "Caixa:cancelarItem");

//VENDAS
$router->group('vendas');
$router->get("/relacao", "Vendas:relacao");
$router->get("/", "Vendas:home");
$router->post("/estornar", "Vendas:estornar");

//OBRAS
$router->group("/obras");
$router->get("/", "Obras:home");
$router->get("/relacao", "Obras:relacao");

//NFE
$router->group("nfe");
$router->get("/", "NFE:home");
$router->post("/importar/xml", "NFE:importarXMLSender");
$router->get("/manifestacao", "NFE:manifestacao");
$router->get("/tabela", "NFE:tabela");
$router->get("/danfe/{id}", "NFE:danfe");
$router->post("/excluir", "NFE:excluir");

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
$router->get("/caixaDiario/tabela", "CaixaDiario:jsonRelatorio");
$router->get("/caixaDiario/imprimir/{id}", "Relatorios:imprimirCaixaDiario");


//CONSULTA DE PRECOS
$router->group("consultaPreco");
$router->get("/", "ConsultaPreco:home");
$router->get("/tabela", "ConsultaPreco:tabela");

$router->group("/erro");
$router->get("/403", "Erro:e403");

$router->dispatch();

if($router->error()){
    var_dump($router->error());
}