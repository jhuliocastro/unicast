<?php
namespace Controller;

use Core\TButton;
use Core\TForm;
use Core\TInput;
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

        //BOTAO DE CADASTRO
        $botaoCadastro = new TButton();
        $botaoCadastro->id("botaoCadastro");
        $botaoCadastro->title("Cadastrar Boleto");
        $botaoCadastro->action(2);
        $botaoCadastro->url("/boletos/cadastrar");

        //TABELA
        $tabela = new TTable("tabelaBoletos");
        $tabela->addColumn("ID");
        $tabela->addColumn("Fornecedor");
        $tabela->addColumn("Emissão");
        $tabela->addColumn("Vencimento");
        $tabela->addColumn("Valor");
        $tabela->addColumn("Valor Pago");
        $tabela->addColumn("Pagamento");
        $tabela->addColumn("");

        $page->addTable($tabela->close());

        $page->addButton($botaoCadastro->show());

        $page->close();
    }

    public function cadastrar(){
        $page = new TPage(1, "Cadastrar Boleto");

        $numeroDocumento = new TInput();
        $numeroDocumento->type("number");
        $numeroDocumento->id("numeroDocumento");
        $numeroDocumento->label("Número Documento");
        $numeroDocumento->required(true);
        $numeroDocumento = $numeroDocumento->close();

        $codigoBarras = new TInput();
        $codigoBarras->type("number");
        $codigoBarras->id("codigoBarras");
        $codigoBarras->label("Código de Barras");
        $codigoBarras = $codigoBarras->close();

        $form = new TForm('formCadastro', 'post', '/boletos/cadastrar', false);

        $form->addInput($numeroDocumento);
        $form->addInput($codigoBarras);
        $form->addSubmit("salvar", "Salvar");

        $form = $form->show();

        $page->addForm($form);

        $page->close();
    }
}