<?php
namespace Controller;

use Core\TPage;
use Core\TTable;

class Boletos extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        $page = new TPage(0, "Boletos");

        $tabela = new TTable("tabelaBoletos");
        $tabela->addColumn("ID");
        $tabela->addColumn("Fornecedor");
        $tabela->addColumn("Emissão");
        $tabela->addColumn("Vencimento");
        $tabela->addColumn("Valor");
        $tabela->addColumn("Valor Pago");
        $tabela->addColumn("Pagamento");
        $tabela->addColumn("");
    }
}