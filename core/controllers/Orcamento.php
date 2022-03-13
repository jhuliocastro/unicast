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
            $this->router->redirect("/pdv/orcamento/aberto");
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
        Alert::question("Deseja finalizar o orçamento?", "", "/pdv/orcamento/finalizarSender", "/pdv/orcamento/aberto");
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
        $retorno = $orcamentos->cancelarAbertos();
        if($retorno == true){
            Alert::success("Orçamento finalizado!", "Dirija-se ao caixa.", "/pdv/orcamento");
        }else{
            Alert::error("Erro ao finalizar orçamento!", "Consulte o log para mais informações.", "/pdv/orcamento");
        }
    }

    public function aberto(){
        $valorTotalOrcamento = 0;

        $orcamentos = new Orcamentos_Model();
        $retorno = $orcamentos->abertos();
        if(!isset($_SESSION["orcamento"])){
            $_SESSION["orcamento"] = $retorno->id;
        }

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

        parent::render("orcamentoPDV", [
            "cliente" => $cliente->nome,
            "tabela" => $tabela,
            "valorTotal" => $valorTotalOrcamento,
            "valorTotalJS" => $valorTotalOrcamentoJS
        ]);
    }
    public function tabela(){
        $tabela["header"][] = [
            "name" => "id",
            "title" => "ID",
            "sortable" => true,
            "sortDir" => "desc",
            "format" => "number"
        ];
        $tabela["header"][] = [
            "name" => "cliente",
            "title" => "Cliente",
            "sortable" => true
        ];
        $tabela["header"][] = [
            "name" => "valor",
            "title" => "Valor",
            "sortable" => true
        ];
        $tabela["header"][] = [
            "name" => "status",
            "title" => "Status"
        ];

        $orcamentos = new Orcamentos_Model();
        $orcamentos = $orcamentos->lista();
        foreach ($orcamentos as $orcamento){
            $clientes = new Clientes_Model();
            $cliente = $clientes->dadosClienteID($orcamento->cliente);

            $valor = number_format($orcamento->valor, 2, ",", ".");

            $status = null;

            if($orcamento->aberto == true){
                $status = "<img src='/assets/images/circuloVermelho.png' data-role='hint' data-hint-text='Em Aberto'>";
            }else{
                if($orcamento->faturado == true){
                    $status = "<img src='/assets/images/circuloVerde.png' data-role='hint' data-hint-text='Faturado'>";
                }else{
                    $status = "<img src='/assets/images/circuloAmarelo.png' data-role='hint' data-hint-text='Pedente de Faturamento'>";
                }
            }

            $tabela["data"][] = [
                $orcamento->id,
                $cliente->nome,
                "R$ ".$valor,
                $status
            ];
        }

        echo json_encode($tabela);
    }
}