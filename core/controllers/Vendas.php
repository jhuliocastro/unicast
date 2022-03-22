<?php

namespace Controller;

use Model\Clientes_Model;
use Model\Produtos_Model;
use Model\Vendas_Model;

class Vendas extends Controller
{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home()
    {
        parent::render("vendas");
    }

    public function relacao()
    {
        $model = new Vendas_Model();
        $listaVendas = $model->lista();

        foreach ($listaVendas as $venda) {
            $modelCliente = new Clientes_Model();
            $dadosCliente = $modelCliente->dadosClienteID($venda->cliente);
            $tabela["data"][] = [
                $venda->id,
                $dadosCliente->nome,
                $venda->orcamento,
                "R$ " . number_format($venda->valorTotal, 2, ',', '.'),
                "R$ " . number_format($venda->valorPago, 2, ',', '.'),
                $venda->formaPagamento,
                date("d/m/Y H:i:s", strtotime($venda->created_at)),
                ""
            ];
        }

        echo json_encode($tabela);
    }
}