<?php

namespace Controller;

use Alertas\Alert;
use Model\CaixaDiario_Model;
use Model\Clientes_Model;
use Model\Orcamentos_Model;
use Model\OrcamentosPedido_Model;
use Model\Produtos_Model;
use Model\Vendas_Model;
use Model\Vendas_Produtos_Model;

class Caixa extends Controller
{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function md5() : string{
        $md5 = md5(time() . rand(0, 9999) . time());
        return $md5;
    }

    private function criaJSON($md5){
        $nomeArquivo = __DIR__."/../../temp/".$md5.".json";
        if(!file_exists($nomeArquivo)){
            $arquivo = fopen($nomeArquivo, 'w+');
        }

        $data["data"] = [];

        file_put_contents($nomeArquivo, json_encode($data));
    }

    public function cancelarItem(){
        error_reporting(0);
        $nomeArquivo = __DIR__."/../../temp/".$_POST["md5"].".json";
        $arquivo = file_get_contents($nomeArquivo);
        $arquivo = json_decode($arquivo, true);
        $i = 0;
        foreach($arquivo["data"] as $produto){
            if($produto[0] == $_POST["idProduto"]){
                unset($arquivo["data"][$i]);

                $retorno = [
                    "quantidade" => $produto[2],
                    "valorTotal" => $produto[4]
                ];
            }
            
            $i++;
        }

        foreach($arquivo["data"] as $produto){
            $dados["data"][] = $produto;
        }

        if($dados == null){
            $dados["data"] = []; 
        }

        $arquivo = json_encode($dados);

        if($arquivo == null){
            $dados["data"][] = [];
            file_put_contents($nomeArquivo, $dados);
        }else{
            file_put_contents($nomeArquivo, $arquivo);
        }

        //echo $arquivo;
        

        echo json_encode($retorno);
    }

    public function json(){
        $nomeArquivo = __DIR__."/../../temp/".$_POST["md5"].".json";
        if(!file_exists($nomeArquivo)){
            $arquivo = fopen($nomeArquivo, 'w+');
        }

        $arquivo = file_get_contents($nomeArquivo);

        $arquivo = json_decode($arquivo, true);
        $arquivo["data"][] = [
            $_POST["idProduto"],
            $_POST["nomeProduto"],
            $_POST["quantidade"],
            "R$ ".$_POST["valorUN"],
            "R$ ".$_POST["valorTotal"]
        ];

        var_dump($arquivo);

        $arquivo = json_encode($arquivo);

        $arquivo = file_put_contents($nomeArquivo, $arquivo);
    }

    public function home()
    {
        $selectClientes = null;

        $clientesModel = new Clientes_Model();
        $clientes = $clientesModel->listaClientes();
        foreach($clientes as $cliente){
            if($cliente->nome == "Consumidor"){
                $selectClientes .= "
                <option selected id='$cliente->id'>$cliente->nome</option>
            ";
            }else{
                $selectClientes .= "
                <option id='$cliente->id'>$cliente->nome</option>
            ";
            }
        }

        $model = new Produtos_Model();
        $produtos = $model->lista();
        $produtosLista = null;
        foreach($produtos as $produto){
            $produtosLista .= "
                <option>$produto->nome</option>
            ";
        }

        $md5 = $this->md5();

        $this->criaJSON($md5);

        parent::render("caixaTeste", [
            "clientes" => $selectClientes,
            "listaProdutos" => $produtosLista,
            "md5" => $md5
        ]);

        /*
        unset($_SESSION["caixaProdutos"]);
        unset($_SESSION["clienteCaixa"]);
        $_SESSION["clienteCaixa"] = 1;

        $model = new Orcamentos_Model();
        $orcamentos = $model->listaNaoFaturados();
        $tabelaOrcamento = null;
        foreach ($orcamentos as $orcamento) {
            if ($orcamento->aberto == 0) {
                $modelCliente = new Clientes_Model();
                $cliente = $modelCliente->dadosClienteID($orcamento->cliente);
                $orcamento->cliente = $cliente->nome;

                $valor = number_format($orcamento->valor, 2, ",", ".");
                $tabelaOrcamento .= "
                <tr>
                    <td>$orcamento->id</td>
                    <td>$orcamento->cliente</td>
                    <td>R$ $valor</td>
                </tr>
            ";
            }
        }

        $model = new Produtos_Model();
        $produtos = $model->lista();
        $produtosLista = null;
        foreach($produtos as $produto){
            $produtosLista .= "
                <option>$produto->nome</option>
            ";
        }

        parent::render("caixa", [
            "orcamentos" => $tabelaOrcamento,
            "produtos" => $produtosLista
        ]);*/
    }

    public function pesquisarProduto(){
        $model = new Produtos_Model();
        $retorno = $model->verificaProdutoExiste($_POST["produto"]);
        if($retorno == 0){
            $retorno = [
                "status" => false,
                "erro" => "Produto não existe!"
            ];
        }else{
            $retorno = $model->retornaID($_POST["produto"]);
            $retorno = [
                "status" => true,
                "codigoBarras" => $retorno->codigoBarras
            ];
        }

        echo json_encode($retorno);
    }

    public function valorTotal(){
        $model = new Orcamentos_Model();
        $dados = $model->dadosID($_POST["orcamento"]);
        $dados->valor = number_format($dados->valor, 2, ",", ".");
        echo $dados->valor;
    }

    public function importar()
    {
        if(isset($_SESSION["caixa"]["produtos"])){
            unset($_SESSION["caixa"]["produtos"]);
            unset($_SESSION["caixa"]);
        }

        $modelOrcamento = new Orcamentos_Model();
        $retorno = $modelOrcamento->verificaExiste($_POST["orcamento"]);

        $_SESSION["caixa"] = $_POST["orcamento"];

        if ($retorno > 0) {
            $model = new OrcamentosPedido_Model();
            $existe = $model->verificaExiste($_POST["orcamento"]);
            if ($existe > 0) {
                $produtos = $model->retornoProdutos($_POST["orcamento"]);
                $tabela = null;
                foreach ($produtos as $produto) {
                    $modelProduto = new Produtos_Model();
                    $dadosProduto = $modelProduto->retornoPorID($produto->produto);

                    $valorTotal = $dadosProduto->precoVenda * $produto->quantidade;
                    $valorTotal = number_format($valorTotal, 2, ",", ".");
                    $valorUN = number_format($dadosProduto->precoVenda, 2, ",", ".");

                    $_SESSION["caixaProdutos"][] = $dadosProduto->id;

                    $tabela .= "
                        <tr>
                            <td>$dadosProduto->id</td>
                            <td>$dadosProduto->nome</td>
                            <td>$produto->quantidade</td>                    
                            <td>R$ $valorUN</td>
                            <td>R$ $valorTotal</td>
                        </tr>
                    ";
                }

                echo $tabela;
            } else {
                echo "em branco";
            }
        } else {
            echo "nao existe";
        }
    }

    public function pagamento(){
        $dinheiro = $_POST["dinheiro"];
        $credito = $_POST["credito"];
        $debito = $_POST["debito"];
        $pix = $_POST["pix"];
        $crediario = $_POST["crediario"];
        $valorTotal = $_POST["valorTotal"];
        $desconto = $_POST["desconto"];
        $cliente = $_POST["cliente"];
        $orcamento = $_POST["orcamento"];
        $produtos = json_decode($_POST["produtos"]);

        $arquivo = 'produtos.json';
        $json = json_encode($produtos);
        $file = fopen(__DIR__ . '/../../temp/' . $arquivo,'w');
        fwrite($file, $json);
        fclose($file);

        if($orcamento == ""){
            $orcamento = null;
        }

        $model = new Clientes_Model();
        $dadosCliente = $model->dadosClienteNome($cliente);

        if($dinheiro == "") $dinheiro = 0;
        if($credito == "") $credito = 0;
        if($debito == "") $debito = 0;
        if($pix == "") $pix = 0;
        if($crediario == "") $crediario = 0;

        $dinheiro = str_replace('.', '', $dinheiro);
        $dinheiro = str_replace(',', '.', $dinheiro);
        $credito = str_replace('.', '', $credito);
        $credito = str_replace(',', '.', $credito);
        $debito = str_replace('.', '', $debito);
        $debito = str_replace(',', '.', $debito);
        $pix = str_replace('.', '', $pix);
        $pix = str_replace(',', '.', $pix);
        $crediario = str_replace('.', '', $crediario);
        $crediario = str_replace(',', '.', $crediario);

        $troco = 0;

        $valor = $dinheiro + $credito + $debito + $pix + $crediario;

        //$valor = number_format($valor, 2, ',', '.');

        $model = new Vendas_Model();
        
        if($valor > $valorTotal) {
            (float)$troco = (float)$valor - (float)$valorTotal;
            $valorTotal = $valorTotal + $desconto;
            $retorno = $model->cadastrar($dadosCliente->id, $orcamento, $valorTotal, $dinheiro, $debito, $credito, $crediario, $pix, $troco, $valor, $desconto);
        }else if($valor < $valorTotal){
            $retorno = [
                "status" => false,
                "error" => "Valor declarado não pode ser menor do que o valor da conta!"
            ];
        }else{
            $valorTotal = $valorTotal + $desconto;
            $retorno = $model->cadastrar($dadosCliente->id, $orcamento, $valorTotal, $dinheiro, $debito, $credito, $crediario, $pix, $troco, $valor, $desconto);
        }

        $valorCaixa = $dinheiro - $troco;

        if(isset($retorno["id"])){
            $json = file_get_contents(__DIR__."/../../temp/produtos.json");
            $data = json_decode($json, true);

            foreach ($data["produtos"] as $produto) {
                $model = new Vendas_Produtos_Model();
                $model->cadastrar($retorno["id"], $produto["produto"], $produto["quantidade"]);
            }

            if($dinheiro != 0){
                $this->gravaCaixaDiario($valorCaixa, "VENDA Nº ".$retorno["id"], "Entrada");
            }
        }

        echo json_encode($retorno);
    }

    public function gravaCaixaDiario($valor, $descricao, $tipo){
        $caixaDiario = new CaixaDiario_Model();
        $retorno = $caixaDiario->inserir($valor, $descricao, $tipo);
    }

    private function faturarOrcamento(){
        $orcamento = $_SESSION["caixa"];
        $model = new Orcamentos_Model();
        $model->faturar($orcamento);
    }

    private function saidaProdutos(){
        $orcamento = $_SESSION["caixa"];
        $model = new OrcamentosPedido_Model();
        $produtos = $model->retornoProdutos($orcamento);
        foreach ($produtos as $produto){
            $modelProduto = new Produtos_Model();
            $dadosProduto = $modelProduto->retornoPorID($produto->produto);

            $quantidadeNova = $dadosProduto->estoqueAtual - $produto->quantidade;

            $modelProduto->atualizarEstoque($produto->produto, $quantidadeNova);
        }
    }

    public function trueVenda($data){
        $model = new Vendas_Model();
        $retorno = $model->dadosID($data["id"]);

        $troco = number_format($retorno->troco, 2, ",", ".");

        parent::render("caixaTrue", [
            "id" => $data["id"],
            "troco" => $troco
        ]);
    }

    public function falseVenda(){
        Alert::error("Venda não concluída!", "Contate o suporte.", "/pdv/vendas");
    }

    public function imprimirCupom(){
        $model = new OrcamentosPedido_Model();
        $produtos = $model->retornoProdutos($_SESSION["caixa"]);

        $modelVendas = new Vendas_Model();
        $dadosVenda = $modelVendas->listaUltimo();

        $modelCliente = new Clientes_Model();
        $dadosCliente = $modelCliente->dadosClienteID($dadosVenda->cliente);

        $dados = null;
        foreach ($produtos as $produto){
            $modelProduto = new Produtos_Model();
            $dadosProduto = $modelProduto->retornoPorID($produto->produto);

            $valorTotalProduto = $dadosProduto->precoVenda * $produto->quantidade;
            $valorTotalProduto = number_format($valorTotalProduto, 2, ",", ".");
            $dadosProduto->precoVenda = number_format($dadosProduto->precoVenda, 2, ",", '.');


            $dados .= "
            <tr class=\"top\">
                <td colspan=\"3\">$dadosProduto->nome</td>
            </tr>
            <tr>
                <td>R$ $dadosProduto->precoVenda</td>
                <td>$produto->quantidade</td>
                <td>R$ $valorTotalProduto</td>
            </tr>
            ";
        }

        $subTotal = $dadosVenda->valorTotal;
        $subTotal = number_format($subTotal, 2, ",", ".");

        $total = $dadosVenda->valorTotal - $dadosVenda->desconto;
        $total = number_format($total, 2, ",", ".");

        parent::render("cupom", [
            "produtos" => $dados,
            "cliente" => $dadosCliente->nome,
            "cpf" => $dadosCliente->cpf,
            "dataHora" => date("d/m/Y H:i:s", strtotime($dadosVenda->created_at)),
            "desconto" => number_format((float)$dadosVenda->desconto, 2, ",", "."),
            "subTotal" => $subTotal,
            "total" => $total,
            "modoPagamento" => $dadosVenda->formaPagamento,
            "troco" => number_format($dadosVenda->troco, 2, ",", "."),
            "valorPago" => number_format($dadosVenda->valorPago, 2, ",", "."),
            "numeroVenda" => $dadosVenda->id
        ]);
    }
}