<?php
namespace Controller;

use Alertas\Alert;
use Model\Clientes_Model;
use Model\Orcamentos_Model;
use Model\OrcamentosPedido_Model;
use Model\Produtos_Model;
use Dompdf\Dompdf;

class Orcamento extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        $clientes = new Clientes_Model();
        $clientes = $clientes->find()->fetch(true);
        $listaClientes = null;
        if($clientes !== null){
            foreach($clientes as $cliente){
                $listaClientes .= "
                    <option>$cliente->nome</option>
                ";
            }
        }
        $this->render("orcamento", [
            "clientes" => $listaClientes
        ]);
    }

    public function novo(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $cliente = $_POST["cliente"];

        $clientes = new Clientes_Model();
        $dadosCliente = $clientes->find("nome=:nome", "nome=$cliente")->fetch();

        $orcamento = new Orcamentos_Model();
        $orcamento->cliente = $dadosCliente->id;
        $orcamento->aberto = true;
        $orcamento->valor = 0.00;
        $orcamento->save();
        if($orcamento->fail()){
            Alert::error('Falha ao abrir orçamento!', $orcamento->fail()->getMessage(), '/orcamento');
            exit();
        }

        $this->log('ABRIU ORCAMENTO | ID: '.$orcamento->data->id);
        $_SESSION["orcamento"] = $orcamento->data->id;
        $this->router->redirect("/orcamento/".$orcamento->data->id);
    }

    public function orcamento($data){
        $orcamento = (new Orcamentos_Model())->findById($data["id"]);

        $this->render("orcamentoPDV", [
            "orcamento" => $data["id"],
            "valorTotal" => "R$ ".$orcamento->valor
        ]);
    }

    public function valorTotal(){
        $dadosOrcamento = (new Orcamentos_Model())->findById($_POST["orcamento"]);
        echo number_format((float)$dadosOrcamento->valor, 2, ',', '.');
    }

    public function pesquisarProduto(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $codigo = $_POST["codigo"];
        $orcamento = new OrcamentosPedido_Model();
        $orcamento->orcamento = $_SESSION["orcamento"];
        $orcamento->quantidade = $_POST["quantidade"];
        $produtos = new Produtos_Model();
        $pesquisaCodigoBarras = $produtos->find('codigoBarras=:codigoBarras', "codigoBarras=$codigo")->fetch();
        if($pesquisaCodigoBarras === null){
            $pesquisaID = $produtos->findById($codigo);
            if($pesquisaID === null){
                $retorno = [
                    "status" => false,
                    "erro" => "Produto não encontrado!"
                ];
            }else{
                $orcamento->produto = $pesquisaID->id;
                $produtoRetorno = $pesquisaID->nome;
                $unidadeMedida = $pesquisaID->unidadeMedida;
                $valorProduto = $pesquisaID->precoVenda * $_POST["quantidade"];
                $orcamento->save();

                //ATUALIZA VALOR DO ORCAMENTO
                $dadosOrcamento = (new Orcamentos_Model())->findById($_SESSION["orcamento"]);
                $valorOrcamento = $dadosOrcamento->valor + $valorProduto;
                $dadosOrcamento->valor = $valorOrcamento;
                $dadosOrcamento->save();

                $valorTotal = number_format((float)$valorProduto, 2, ',', '.');
                if($orcamento->fail()){
                    $retorno = [
                        "status" => false,
                        "erro" => $orcamento->fail()->getMessage()
                    ];
                }else{
                    $retorno = [
                        "status" => true,
                        "produto" => $produtoRetorno,
                        "unidadeMedida" => $unidadeMedida,
                        "valorTotal" => $valorProduto
                    ];
                }
            }
        }else{
            $orcamento->produto = $pesquisaCodigoBarras->id;
            $produtoRetorno = $pesquisaCodigoBarras->nome;
            $unidadeMedida = $pesquisaCodigoBarras->unidadeMedida;
            $valorProduto = $pesquisaCodigoBarras->precoVenda * $_POST["quantidade"];
            $orcamento->save();

            //ATUALIZA VALOR DO ORCAMENTO
            $dadosOrcamento = (new Orcamentos_Model())->findById($_SESSION["orcamento"]);
            $valorOrcamento = $dadosOrcamento->valor + $valorProduto;
            $dadosOrcamento->valor = $valorOrcamento;
            $dadosOrcamento->save();

            $valorTotal = number_format((float)$valorProduto, 2, ',', '.');
            if($orcamento->fail()){
                $retorno = [
                    "status" => false,
                    "erro" => $orcamento->fail()->getMessage()
                ];
            }else{
                $retorno = [
                    "status" => true,
                    "produto" => $produtoRetorno,
                    "unidadeMedida" => $unidadeMedida,
                    "valorTotal" => $valorProduto
                ];
            }
        }

        echo json_encode($retorno);
    }

    public function exportarPDF($data){
        /*$model = new Orcamentos_Model();
        $dadosOrcamento = $model->dadosID($id);

        $model = new OrcamentosPedido_Model();
        $produtosOrcamento = $model->retornoProdutos($id);


        $variavel = parent::html("orcamentoPDF");

        print_r($variavel);*/

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

        $valorTotalOrcamento = number_format((float)$valorTotalOrcamento, 2, ",", ".");

        $html = parent::html("orcamentoPDF", [
            "cliente" => $cliente->nome,
            "tabela" => $tabela,
            "valorTotal" => $valorTotalOrcamento,
            "valorTotalJS" => $valorTotalOrcamentoJS,
            "produtos" => $listaProdutos
        ]);

        //GERAR PDF
        //echo $html;

        $nomeArquivo = $cliente->nome.".pdf";

        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->render();
        $pdf->stream($nomeArquivo);
    }

    public function tabelaProdutos($data){
        $id = $data["id"];

        $dadosOrcamento = new Orcamentos_Model();
        $dadosOrcamento = $dadosOrcamento->findById($id);

        $orcamentos = new OrcamentosPedido_Model();
        $orcamentos = $orcamentos->find("orcamento=:orcamento", "orcamento=$id")->order("id desc")->fetch(true);
        if($orcamentos !== null){
            foreach ($orcamentos as $orcamento){
                $clientes = new Clientes_Model();
                $cliente = $clientes->findById($dadosOrcamento->cliente);

                $produto = new Produtos_Model();
                $produto = $produto->findById($orcamento->produto);

                $valorTotal = $orcamento->quantidade * $produto->precoVenda;
                $precoVenda = number_format((float)$produto->precoVenda, 2, ",", ".");
                $valorTotal = number_format((float)$valorTotal, 2, ",", ".");


                $tabela["data"][] = [
                    $produto->id,
                    $produto->nome,
                    $orcamento->quantidade,
                    "R$ ".$precoVenda,
                    "R$ ".$valorTotal
                ];
            }
        }else{
            $tabela = [];
        }

        echo json_encode($tabela);
    }

    public function tabela(){
        $orcamentos = new Orcamentos_Model();
        $orcamentos = $orcamentos->find()->fetch(true);
        foreach ($orcamentos as $orcamento){
            $clientes = new Clientes_Model();
            $cliente = $clientes->findById($orcamento->cliente);

            $valor = number_format($orcamento->valor, 2, ",", ".");

            $status = null;

            $acoes = null;

            if($orcamento->aberto == true){
                $status = "<img src='/assets/images/circuloVermelho.png' class='imagem-acao' data-role='hint' data-hint-text='Em Aberto'>";
                $acoes .= "
                        <a href='/pdv/orcamento/aberto/$orcamento->id'><img src='/assets/images/abrir.png' class='imagem-acao' data-role='hint' data-hint-text='Abrir'></a>
                        <a href='javascript:void(0)' onclick='exportarPDF($orcamento->id)'><img src='/assets/images/pdf.png' class='imagem-acao' data-role='hint' data-hint-text='Exportar PDF'></a>
                        <a href='/pdv/orcamento/excluir/$orcamento->id'><img src='/assets/images/excluir.png' class='imagem-acao' data-role='hint' data-hint-text='Excluir'></a>
                    ";
            }else{
                if($orcamento->faturado == true){
                    $status = "<img src='/assets/images/circuloVerde.png' class='imagem-acao' data-role='hint' data-hint-text='Faturado'>";
                    $acoes .= "
                        <a href='/pdv/orcamento/fechado/$orcamento->id'><img src='/assets/images/abrir.png' class='imagem-acao' data-role='hint' data-hint-text='Abrir'></a>
                        <a href='javascript:void(0)' onclick='exportarPDF($orcamento->id)'><img src='/assets/images/pdf.png' class='imagem-acao' data-role='hint' data-hint-text='Exportar PDF'></a>
                        <a href='/pdv/orcamento/excluir/$orcamento->id' disabled><img src='/assets/images/excluir.png' class='imagem-acao' style='-webkit-filter: grayscale(100%);' data-role='hint' data-hint-text='Excluir'></a>
                    ";
                }else{
                    $status = "<img src='/assets/images/circuloAmarelo.png' class='imagem-acao' data-role='hint' data-hint-text='Pedente de Faturamento'>";
                    $acoes .= "
                        <a href='/pdv/orcamento/aberto/$orcamento->id'><img src='/assets/images/abrir.png' class='imagem-acao' data-role='hint' data-hint-text='Abrir'></a>
                        <a href='javascript:void(0)' onclick='exportarPDF($orcamento->id)'><img src='/assets/images/pdf.png' class='imagem-acao' data-role='hint' data-hint-text='Exportar PDF'></a>
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


}