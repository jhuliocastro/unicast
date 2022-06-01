<?php
namespace Controller;

use Alertas\Alert;
use Core\TButton;
use Core\TPage;
use Core\TTable;
use Model\Clientes_Model;

class Clientes extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function cadastrar(){
        parent::render("clientesCadastrar");
    }

    public function cadastrarSender(){
        $dados = (object) $_POST;
        $clientesModel = new Clientes_Model();
        $retorno = $clientesModel->cadastrar($dados);
        if($retorno == true){
            Alert::success("Cliente Cadastrado com Sucesso!", "", "/clientes/relacao");
        }else if($retorno == false){
            Alert::success("Erro ao cadastrar cliente!", "Consulte o log para mais informações.", "/clientes/relacao");
        }
    }

    public function tabela(){
        $model = new Clientes_Model();
        $listaClientes = $model->listaClientes();
        foreach($listaClientes as $cliente){
            $tabela["data"][] = [
              $cliente->id,
              $cliente->nome,
              $cliente->cpf
            ];
        }

        echo json_encode($tabela);
    }

    public function relacao(){
        $tabela = new TTable("tabelaClientes");

        $tabela->addColumn("ID");
        $tabela->addColumn("Nome Completo");
        $tabela->addColumn("CPF/CNPJ");

        $tabela->urlData("/clientes/tabela");
        $tabela->paging(true, 50);
        $tabela->order(1, "asc");

        $tabela = $tabela->close();

        $pagina = new TPage(0, "Clientes");

        $botaoCadastrar = new TButton();
        $botaoCadastrar->id("botaoCadastrar");
        $botaoCadastrar->title("Cadastrar");
        $botaoCadastrar->action(2);
        $botaoCadastrar->url("/clientes/cadastrar");
        $botaoCadastrar = $botaoCadastrar->show();

        $pagina->addButton($botaoCadastrar);

        $pagina->addTable($tabela);
        $pagina->close();
    }
}