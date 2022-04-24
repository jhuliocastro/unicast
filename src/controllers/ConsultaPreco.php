<?php
namespace Controller;

use Core\TPage;
use Core\TTable;
use Model\Produtos_Model;

class ConsultaPreco extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        $tabela = new TTable("tabelaPreco");

        $tabela->addColumn("ID");
        $tabela->addColumn("PRODUTO");
        $tabela->addColumn("VALOR");

        $tabela->urlData("/consultaPreco/tabela");
        $tabela->paging(true, 50);
        $tabela->order(1, "asc");

        $tabela = $tabela->close();

        $page = new TPage(0, "CONSULTA DE PREÇOS");
        $page->addTable($tabela);
        $page->close();
    }

    public function tabela(){
        $produtosModel = new Produtos_Model();
        $produtosLista = $produtosModel->lista();
        foreach($produtosLista as $produto){
            $tabela["data"][] = [
                $produto->id,
                $produto->nome,
                "R$ ".number_format($produto->precoVenda, 2, ',', '.')
            ];
        }

        echo json_encode($tabela);
    }
}