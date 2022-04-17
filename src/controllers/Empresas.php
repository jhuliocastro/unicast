<?php
namespace Controller;

use Model\Empresas_Model;

class Empresas extends Controller{
    public function __construct($router){
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        parent::render("empresas");
    }

    public function tabela(){
        $empresas = new Empresas_Model();
        $listaEmpresas = $empresas->lista();

        $tabela = null;

        foreach($listaEmpresas as $empresa){
            $acoes = "
            <a href='/empresas/editar/$empresa->id'><img src='/assets/images/editar.png' data-role='hint' data-hint-text='Editar' class='imagem-acao'></a>
            <a href='javascript:void(0)' onclick='abrirJanelaAlterarValor($empresa->id)'><img src='/assets/images/valor.png' data-role='hint' data-hint-text='Alterar Valor' class='imagem-acao'></a>
            <a href='javascript:void(0)' onclick='entradaEstoque($empresa->id)'><img src='/assets/images/entradaEstoque.png' data-role='hint' data-hint-text='Entrada Estoque' class='imagem-acao'></a>
            <a href='javascript:void(0)' onclick='saidaEstoque($empresa->id)'><img id='saidaEstoque' src='/assets/images/saidaEstoque.png' data-role='hint' data-hint-text='Saída Estoque' class='imagem-acao'></a>
            ";
                $tabela["data"][] = [
                    $empresa->id,
                    $empresa->cnpj,
                    $empresa->razaoSocial,
                    $empresa->nomeFantasia,
                    $acoes
                ];
        }

        echo json_encode($tabela);
    }

}