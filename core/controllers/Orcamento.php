<?php
namespace Controller;

use Alertas\Alert;
use Model\Clientes_Model;
use Model\Orcamentos_Model;
use Model\OrcamentosPedido_Model;
use Model\Produtos_Model;

class Orcamento extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        parent::render("orcamento");
    }

    public function novo(){
        if(isset($_SESSION["orcamento"])){
            unset($_SESSION["orcamento"]);
            unset($_SESSION["valorTotalOrcamento"]);
        }

        $orcamentoModel = new Orcamentos_Model();
        $statusOrcamento = $orcamentoModel->pesquisaStatus();

        $tabela = null;
        $clientesModel = new Clientes_Model();
        $clientes = $clientesModel->listaClientes();
        foreach ($clientes as $cliente){
            $tabela .= "
                <option>$cliente->nome</option>
            ";
        }
        parent::render("orcamentoNovo", [
            "clientes" => $tabela
        ]);
    }

    public function orcamento($data){
        //PESQUISA ID DO CLIENTE INFORMADO
        $clientes = new Clientes_Model();
        $dadosCliente = $clientes->dadosClienteNome($_POST["cliente"]);

        //ABRE O ORÇAMENTO
        $orcamentos = new Orcamentos_Model();
        $retorno = $orcamentos->novo($dadosCliente->id);

        if($retorno == true){
            $this->router->redirect("/pdv/orcamento");
        }else{
            Alert::error("Erro ao abrir orçamento!", "Verifique o log para mais informaçãoes.", "/pdv/orcamento");
        }
    }

    public function cancelar(){
        $orcamentos = new Orcamentos_Model();
        $retorno = $orcamentos->cancelarAbertos();
        if($retorno == true){
            $this->router->redirect("/pdv/orcamento/aberto");
        }else{
            Alert::error("Erro ao cancelar orçamento!", "Verifique o log para mais informaçãoes.", "/dashboard");
        }
    }

    public function finalizar(){
        $orcamento = $_SESSION["orcamento"];
        Alert::question("Deseja finalizar o orçamento?", "", "/pdv/orcamento/finalizarSender", "/pdv/orcamento/aberto/$orcamento");
    }

    public function finalizarSender(){
        $valorTotal = 0;

        $orc = new OrcamentosPedido_Model();
        $produtos = $orc->retornoProdutos($_SESSION["orcamento"]);

        foreach($produtos as $produto){
            $prod = new Produtos_Model();
            $dadosProduto = $prod->retornoPorID($produto->produto);
            $valor = $dadosProduto->precoVenda * $produto->quantidade;
            $valorTotal = $valorTotal + $valor;
        }

        $orcamentos = new Orcamentos_Model();
        $orcamentos->atualizarValor($_SESSION["orcamento"], $valorTotal);
        $retorno = $orcamentos->finalizar($_SESSION["orcamento"]);
        unset($_SESSION["orcamento"]);
        if($retorno == true){
            Alert::success("Orçamento finalizado!", "Dirija-se ao caixa.", "/pdv/orcamento");
        }else{
            Alert::error("Erro ao finalizar orçamento!", "Consulte o log para mais informações.", "/pdv/orcamento");
        }
    }

    public function dados(){
        $model = new Orcamentos_Model();
        $retorno = $model->dadosID($_POST["orcamento"]);
        $cliente = $retorno->cliente;

        $model = new Clientes_Model();
        $retorno = $model->dadosClienteID($cliente);

        $_SESSION["clienteCaixa"] = $retorno->id;

        echo $retorno->nome;
    }

    public function aberto($data){
        $valorTotalOrcamento = 0;

        $orcamentos = new Orcamentos_Model();
        $retorno = $orcamentos->dadosID($data["id"]);

        $_SESSION["orcamento"] = $retorno->id;

        $orcamentoAberto = new OrcamentosPedido_Model();
        $produtos = $orcamentoAberto->retornoProdutos($retorno->id);
        $tabela = null;

        if($produtos == null){
            $valorTotalOrcamentoJS = 0;
        }else{
            foreach ($produtos as $produto){
                $model = new Produtos_Model();
                $dadosProduto = $model->retornoPorID($produto->produto);

                $valorUN = number_format($dadosProduto->precoVenda, 2, ",", ".");
                $valorUN = "R$ ".$valorUN;

                $valorTotal = $dadosProduto->precoVenda * $produto->quantidade;
                $valorTotalOrcamento = (float)$valorTotalOrcamento + (float)$valorTotal;
                $valorTotal = number_format($valorTotal, 2, ",", ".");
                $valorTotal = "R$ ".$valorTotal;

                $valorTotalOrcamentoJS = $valorTotalOrcamento;
                //(float)$valorTotalOrcamento = str_replace(".", ",", (float)$valorTotalOrcamento);

                //$valorTotalOrcamento = number_format($valorTotalOrcamento, 2, ",", ".");

                $tabela .= "
            <tr>
                <td>$dadosProduto->id</td>
                <td>$dadosProduto->nome</td>
                <td>$produto->quantidade</td>
                <td>$valorUN</td>
                <td>$valorTotal</td>
            </tr>
            ";
            }
        }

        //CONSULTA O NOME DO CLIENTE
        $clientes = new Clientes_Model();
        $cliente = $clientes->dadosClienteID($retorno->cliente);

        //LISTA DE PRODUTOS
        $modelProdutos = new Produtos_Model();
        $produtos = $modelProdutos->lista();
        $listaProdutos = null;
        foreach($produtos as $produto){
            $listaProdutos .= "
                <option>$produto->nome</option>
            ";
        }

        parent::render("orcamentoPDV", [
            "cliente" => $cliente->nome,
            "tabela" => $tabela,
            "valorTotal" => $valorTotalOrcamento,
            "valorTotalJS" => $valorTotalOrcamentoJS,
            "produtos" => $listaProdutos
        ]);
    }

    public function fechado($data){
        $valorTotalOrcamento = 0;

        $orcamentos = new Orcamentos_Model();
        $retorno = $orcamentos->dadosID($data["id"]);

        $_SESSION["orcamento"] = $retorno->id;

        $orcamentoAberto = new OrcamentosPedido_Model();
        $produtos = $orcamentoAberto->retornoProdutos($retorno->id);
        $tabela = null;

        if($produtos == null){
            $valorTotalOrcamentoJS = 0;
        }else{
            foreach ($produtos as $produto){
                $model = new Produtos_Model();
                $dadosProduto = $model->retornoPorID($produto->produto);

                $valorUN = number_format($dadosProduto->precoVenda, 2, ",", ".");
                $valorUN = "R$ ".$valorUN;

                $valorTotal = $dadosProduto->precoVenda * $produto->quantidade;
                $valorTotalOrcamento = (float)$valorTotalOrcamento + (float)$valorTotal;
                $valorTotal = number_format($valorTotal, 2, ",", ".");
                $valorTotal = "R$ ".$valorTotal;

                $valorTotalOrcamentoJS = $valorTotalOrcamento;
                //(float)$valorTotalOrcamento = str_replace(".", ",", (float)$valorTotalOrcamento);

                //$valorTotalOrcamento = number_format($valorTotalOrcamento, 2, ",", ".");

                $tabela .= "
            <tr>
                <td>$dadosProduto->id</td>
                <td>$dadosProduto->nome</td>
                <td>$produto->quantidade</td>
                <td>$valorUN</td>
                <td>$valorTotal</td>
            </tr>
            ";
            }
        }

        //CONSULTA O NOME DO CLIENTE
        $clientes = new Clientes_Model();
        $cliente = $clientes->dadosClienteID($retorno->cliente);

        //LISTA DE PRODUTOS
        $modelProdutos = new Produtos_Model();
        $produtos = $modelProdutos->lista();
        $listaProdutos = null;
        foreach($produtos as $produto){
            $listaProdutos .= "
                <option>$produto->nome</option>
            ";
        }

        parent::render("orcamentoFechado", [
            "cliente" => $cliente->nome,
            "tabela" => $tabela,
            "valorTotal" => $valorTotalOrcamento,
            "valorTotalJS" => $valorTotalOrcamentoJS,
            "produtos" => $listaProdutos
        ]);
    }

    public function tabela(){
        $orcamentos = new Orcamentos_Model();
        $orcamentos = $orcamentos->lista();
        foreach ($orcamentos as $orcamento){
            $clientes = new Clientes_Model();
            $cliente = $clientes->dadosClienteID($orcamento->cliente);

            $valor = number_format($orcamento->valor, 2, ",", ".");

            $status = null;

            $acoes = null;

            if($orcamento->aberto == true){
                $status = "<img src='/assets/images/circuloVermelho.png' class='imagem-acao' data-role='hint' data-hint-text='Em Aberto'>";
                $acoes .= "
                        <a href='/pdv/orcamento/aberto/$orcamento->id'><img src='/assets/images/abrir.png' class='imagem-acao' data-role='hint' data-hint-text='Abrir'></a>
                        <a href='/pdv/orcamento/excluir/$orcamento->id'><img src='/assets/images/excluir.png' class='imagem-acao' data-role='hint' data-hint-text='Excluir'></a>
                    ";
            }else{
                if($orcamento->faturado == true){
                    $status = "<img src='/assets/images/circuloVerde.png' class='imagem-acao' data-role='hint' data-hint-text='Faturado'>";
                    $acoes .= "
                        <a href='/pdv/orcamento/fechado/$orcamento->id'><img src='/assets/images/abrir.png' class='imagem-acao' data-role='hint' data-hint-text='Abrir'></a>
                        <a href='/pdv/orcamento/excluir/$orcamento->id' disabled><img src='/assets/images/excluir.png' class='imagem-acao' style='-webkit-filter: grayscale(100%);' data-role='hint' data-hint-text='Excluir'></a>
                    ";
                }else{
                    $status = "<img src='/assets/images/circuloAmarelo.png' class='imagem-acao' data-role='hint' data-hint-text='Pedente de Faturamento'>";
                    $acoes .= "
                        <a href='/pdv/orcamento/aberto/$orcamento->id'><img src='/assets/images/abrir.png' class='imagem-acao' data-role='hint' data-hint-text='Abrir'></a>
                        <a href='/pdv/orcamento/excluir/$orcamento->id'><img src='/assets/images/excluir.png' class='imagem-acao' data-role='hint' data-hint-text='Excluir'></a>
                    ";
                }
            }

            $tabela["data"][] = [
                $orcamento->id,
                $cliente->nome,
                "R$ ".$valor,
                $status,
                $acoes
            ];
        }

        echo json_encode($tabela);
    }

    public function excluir($data){
        Alert::question("Confirma exclusão do orçamento $data[id]?", "Essa ação não tem volta.", "/pdv/orcamento/excluirSender/$data[id]", "/pdv/orcamento");
    }

    public function excluirSender($data){
        $model = new OrcamentosPedido_Model();
        $model->excluir($data["id"]);

        $model = new Orcamentos_Model();
        $retorno = $model->excluir($data["id"]);

        if($retorno == true){
            Alert::success("Orçamento excluído!", "", "/pdv/orcamento");
        }else{
            Alert::error("Erro ao excluir orçamento!", "Contate o administrador do sistema!", "/pdv/orcamento");
        }
    }
}