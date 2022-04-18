<?php
namespace Controller;

use Core\TForm;
use Core\TInput;
use Core\TPage;
use Core\TTable;
use Model\Empresas_Model;

class Empresas extends Controller{
    public function __construct($router){
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        $page = new TPage(0, "Empresas"); //INICIALIZA A PAGINA INDICANDO QUE VAI SER DO TIPO TABELA

        $form = new TForm("cadastro", 0);
        $form->addInput("razaoSocial", "Razão Social", "text", "true", null);
        $form = $form->modal("cadastrarEmpresa", "Cadastrar Empresa", "600", false);

        $page->addForm($form);

        $tabela = new TTable("tabela"); //INICIALIZA A TABELA

        //ADICIONA AS COLUNAS
        $tabela->addColumn("ID");
        $tabela->addColumn("Razão Social");
        $tabela->addColumn("Nome Fantasia");
        $tabela->addColumn("CNPJ");
        $tabela->addColumn("Ações");

        $tabela->urlData("/empresas/tabela"); //INDICA A URL DOS DADOS EM JSON
        $tabela->paging(true, 50); //ATIVA A PAGINAÇÃO POR 50 RESULTADOS POR PAGINA
        $tabela->order(1, "asc"); //ATIVA A ORDENACAO DA TABELA

        $tabela = $tabela->close(); //FINALIZA A TABELA

        $page->addTable($tabela); //ADICIONA A TABELA A PAGINA

        //ADICIONA BOTOES A PAGINA
        $page->addButton("cadastrar", "Cadastrar", "cadastrar()", null);
        $page->addButton("editar", "editar", "", null);

        $page->addJS("empresas");

        $page->close(); //FINALIZA E EXIBE A PAGINA
    }

    public function tabela(){
        $empresas = new Empresas_Model();
        $listaEmpresas = $empresas->list();

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
                    $empresa->razaoSocial,
                    $empresa->nomeFantasia,
                    $empresa->cnpj,
                    $acoes
                ];
        }

        echo json_encode($tabela);
    }

}