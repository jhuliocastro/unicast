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

        foreach($listaProdutos as $produto){
            $acoes = "
            <a href='/produtos/editar/$produto->id'><img src='/assets/images/editar.png' data-role='hint' data-hint-text='Editar' class='imagem-acao'></a>
            <a href='javascript:void(0)' onclick='abrirJanelaAlterarValor($produto->id)'><img src='/assets/images/valor.png' data-role='hint' data-hint-text='Alterar Valor' class='imagem-acao'></a>
            <a href='javascript:void(0)' onclick='entradaEstoque($produto->id)'><img src='/assets/images/entradaEstoque.png' data-role='hint' data-hint-text='Entrada Estoque' class='imagem-acao'></a>
            <a href='javascript:void(0)' onclick='saidaEstoque($produto->id)'><img id='saidaEstoque' src='/assets/images/saidaEstoque.png' data-role='hint' data-hint-text='Saída Estoque' class='imagem-acao'></a>
            ";
                $tabela["data"][] = [
                    $produto->id,
                    $produto->codigoBarras,
                    $produto->nome,
                    "R$ ".number_format($produto->precoVenda, 2, ',', '.'),
                    $produto->estoqueAtual,
                    $produto->unidadeMedida,
                    $acoes
                ];
        }

        echo json_encode($tabela);
    }

    public function dadosID(){
        $model = new Produtos_Model();
        $produto = $model->retornoPorID($_POST["id"]);
        $valorVenda = number_format($produto->precoVenda, 2, ',', '.');
        $valorCompra = number_format($produto->precoCompra, 2, ",", ".");
        $retorno = [
            "produto" => $produto->nome,
            'valorCompra' => $valorCompra,
            'valorVenda' => $valorVenda
        ];
        echo json_encode($retorno);
    }

    public function alterarValor(){
        $dados = (object)$_POST;

        $dados->valorVenda = str_replace(".", "", $dados->valorVenda);
        $dados->valorVenda = str_replace(",", ".", $dados->valorVenda);
        $dados->valorVenda = (float) $dados->valorVenda;

        $dados->valorCompra = str_replace(".", "", $dados->valorCompra);
        $dados->valorCompra = str_replace(",", ".", $dados->valorCompra);        
        $dados->valorCompra = (float) $dados->valorCompra;

        $model = new Produtos_Model();
        $retorno = $model->alterarValor($dados->id, $dados->valorCompra, $dados->valorVenda);

        echo json_encode($retorno);
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

    public function pesquisa(){
        $model = new Produtos_Model();
        $dados = $model->retornaID($_POST["produto"]);
        $dados = [
            "codigoBarras" => $dados->codigoBarras
        ];
        echo json_encode($dados);
    }

    public function cadastrar(){
        $dados = (object)$_POST;

        $retorno = [];

        //VERIFICA SE PRODUTO JÁ EXISTE
        $existe = $this->verificaProdutoExiste($dados->nome);
        if($existe > 0){
            $retorno = [
                "status" => false,
                "erro" => "existe"
            ];
        }else{
            if($dados->precoVenda == null){
                $dados->precoVenda = 0.00;
            }
            if($dados->precoCompra == null){
                $dados->precoCompra = 0.00;
            }

            $dados->precoCompra = str_replace(",", ".", $dados->precoCompra);
            $dados->precoCompra = (float) $dados->precoCompra;
            $dados->precoVenda = str_replace(",", ".", $dados->precoVenda);
            $dados->precoVenda = (float) $dados->precoVenda;

            $produtos = new Produtos_Model();
            $retorno = $produtos->cadastrar($dados);

        }

        echo json_encode($retorno);
    }

    public function editar($data){
        $model = new Produtos_Model();
        $produto = $model->retornoPorID($data["id"]);
        $produto->precoVenda = number_format($produto->precoVenda, 2, ",", ".");
        $produto->precoCompra = number_format($produto->precoCompra, 2, ",", ".");
        parent::render("produtosEditar", [
            "nomeProduto" => $produto->nome,
            "codigoBarras" => $produto->codigoBarras,
            "precoVenda" => $produto->precoVenda,
            "precoCompra" => $produto->precoCompra,
            "quantidadeMinima" => $produto->estoqueMinimo,
            "quantidadeAtual" => $produto->estoqueAtual,
            "descricao" => $produto->descricao,
            "unidadeMedida" => $produto->unidadeMedida,
            "id" => $produto->id
        ]);
    }

    public function editarSender(){
        $dados = (object)$_POST;

        $dados->precoCompra = str_replace(",", ".", $dados->precoCompra);
        $dados->precoCompra = (float) $dados->precoCompra;
        $dados->precoVenda = str_replace(",", ".", $dados->precoVenda);
        $dados->precoVenda = (float) $dados->precoVenda;
        $dados->estoqueAtual = (int) $dados->estoqueAtual;
        $dados->estoqueMinimo = (int) $dados->estoqueMinimo;

        $model = new Produtos_Model();
        $retorno = $model->editar($dados);

        if($retorno == false){
            parent::log("ERRO AO EDITAR PRODUTO");
            Alert::error("Erro ao editar produto!", "Verifique o log para mais informações.", "/produtos/cadastrar");
        }else if($retorno == true){
            parent::log("PRODUTO EDITADO");
            Alert::success("Produto editado com sucesso!", $dados->nome, "/produtos/relacao");
        }
    }
}