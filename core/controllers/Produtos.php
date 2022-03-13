<?php
namespace Controller;

use Alertas\Alert;
use Model\OrcamentosPedido_Model;
use Model\Produtos_Model;

class Produtos extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function cadastrar(){
        parent::render("produtosCadastrar");
    }

    private function verificaProdutoExiste($produto){
        $produtos = new Produtos_Model();
        return $produtos->verificaProdutoExiste($produto);
    }

    public function relacao(){
        parent::render("produtosRelacao");
    }

    public function tabela(){
        $produtos = new Produtos_Model();
        $listaProdutos = $produtos->lista();

        $tabela["header"][] = [
            "name" => "id",
            "title" => "ID",
            "sortable" => true,
            "format" => "number"
        ];
        $tabela["header"][] = [
            "name" => "produto",
            "title" => "Produto",
            "sortDir" => "asc",
            "sortable" => true
        ];
        $tabela["header"][] = [
            "name" => "precoVenda",
            "title" => "Preço Venda",
            "sortable" => true
        ];
        $tabela["header"][] = [
            "name" => "precoCompra",
            "title" => "Preço Compra",
            "sortable" => true
        ];
        $tabela["header"][] = [
            "name" => "estoqueMinimo",
            "title" => "Estoque Mínimo",
            "sortable" => true
        ];
        $tabela["header"][] = [
            "name" => "estoqueAtual",
            "title" => "Estoque Atual",
            "sortable" => true
        ];
        $tabela["header"][] = [
            "name" => "tipo",
            "title" => "Tipo",
            "sortable" => true
        ];

        foreach($listaProdutos as $produto){
            $tabela["data"][] = [
                $produto->id,
                $produto->nome,
                "R$ ".number_format($produto->precoVenda, 2, ',', '.'),
                "R$ ".number_format($produto->precoCompra, 2, ',', '.'),
                $produto->estoqueMinimo,
                $produto->estoqueAtual,
                $produto->unidadeMedida
            ];
        }

        echo json_encode($tabela);
    }

    public function dados(){
        $produtos = new Produtos_Model();
        $produto = $produtos->dadosCodigoBarras($_POST["codigoBarras"]);
        $dados = [
            "id" => $produto->id,
            "produto" => $produto->nome,
            "valor" => $produto->precoVenda
        ];

        $this->gravarProdutoOrcamento($_SESSION["orcamento"], $produto->id, $_POST['quantidadeDados']);

        echo json_encode($dados);
    }

    private function gravarProdutoOrcamento(int $orcamento, int $produto, int $quantidade){
        $model = new OrcamentosPedido_Model();
        $model->cadastrar($orcamento, $produto, $quantidade);
    }

    public function cadastrarSender(){
        $dados = (object)$_POST;

        //VERIFICA SE PRODUTO JÁ EXISTE
        $existe = $this->verificaProdutoExiste($dados->nome);
        if($existe > 0){
            Alert::error("PRODUTO COM O MESMO NOME JÁ CADASTRADO!", "VERIFIQUE AS INFORMAÇÕES E TENTE NOVAMENTE", "/produtos/cadastrar");
            exit();
        }

        $dados->precoCompra = str_replace(",", ".", $dados->precoCompra);
        $dados->precoCompra = (float) $dados->precoCompra;
        $dados->precoVenda = str_replace(",", ".", $dados->precoVenda);
        $dados->precoVenda = (float) $dados->precoVenda;
        $dados->estoqueAtual = (int) $dados->estoqueAtual;
        $dados->estoqueMinimo = (int) $dados->estoqueMinimo;

        $produtos = new Produtos_Model();
        $retorno = $produtos->cadastrar($dados);

        if($retorno == false){
            parent::log("ERRO CADASTRO DE PRODUTOS");
            Alert::error("Erro ao cadastrar produto!", "Verifique o log para mais informações.", "/produtos/cadastrar");
        }else if($retorno == true){
            parent::log("PRODUTO CADASTRADO");
            Alert::success("Produto cadastrado com sucesso!", "", "/produtos/cadastrar");
        }
    }
}