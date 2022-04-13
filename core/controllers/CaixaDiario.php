<?php
namespace Controller;

use Controller\Controller;
use Model\CaixaDiario_Situacao_Model;
use Model\CaixaDiario_Model;
use Alertas\Alert;

class CaixaDiario extends Controller
{
    public function __construct($router)
    {
        $this->router = $router;
        parent::__construct();
    }

    public function home(){
        $retorno = self::situacaoDiaria();
        if($retorno == 0){
            Alert::question("Caixa ainda não foi aberto!", "Deseja abrir agora?", "/caixaDiario/abrir", "/dashboard");
        }else{
            $dados = self::dados(date("Y-m-d"));
            if($dados->situacao == "FECHADO"){
                Alert::warning("Caixa do dia já foi fechado!", "", "/dashboard");
            }else{
                parent::render("caixaDiario");
            }
        }
    }

    public function cupomSangria($data){
        $model = new CaixaDiario_Model();
        $dados = $model->dadosID($data["id"]);

        parent::render("cupomSangria", [
            "dataHora" => date("d/m/Y H:i:s", strtotime($dados->created_at)),
            "sangria" => $dados->descricao,
            "valor" => $dados->valor
        ]);
    }

    public function tabela(){
        $caixa = new CaixaDiario_Model();
        $lista = $caixa->find()->order("id ASC")->fetch(true);
        $i = 0;
        foreach($lista as $d){
            if(date("Y-m-d") == date("Y-m-d", strtotime($d->created_at))){
                $valor = "R$ ".number_format((float)$d->valor, 2, ",", ".");
                if($d->tipo == "Entrada"){
                    $valor = "<span style='color: darkgreen; font-weight: bold;'>$valor</span>";
                    $opcoes = "<a data-role='hint' disabled data-hint-text='Imprimir' href='#'><img style='cursor: no-drop; -webkit-filter: grayscale(100%);' class='imagem-acao' src='/assets/images/imprimir.png'></a>";
                }else{
                    $valor = "<span style='color: red; font-weight: bold;'>$valor</span>";
                    $opcoes = "<a data-role='hint' onclick='imprimirSaida($d->id)' data-hint-text='Imprimir' href='#'><img class='imagem-acao' src='/assets/images/imprimir.png'></a>";
                }

                if($i == 0){
                    $opcoes .= "<a data-role='hint' disabled data-hint-text='Excluir' href='#'><img style='cursor: no-drop; -webkit-filter: grayscale(100%);' class='imagem-acao' src='/assets/images/excluir.png'></a>";
                }else{
                    $opcoes .= "<a data-role='hint' onclick='excluir($d->id)' data-hint-text='Excluir' href='#'><img class='imagem-acao' src='/assets/images/excluir.png'></a>";
                }

                $i = 1;

                $tabela["data"][] = [
                     $d->id,
                     $d->descricao,
                     $d->tipo,
                     $valor,
                     $opcoes
                ];
            }
        }

        echo json_encode($tabela);
    }

    public function excluir(){
        $model = new CaixaDiario_Model();
        $retorno = $model->excluir($_POST["id"]);
        echo json_encode($retorno);
    }

    public function relatorioDiario(){
        $tabela = null;
        $valor = 0;

        $model = new CaixaDiario_Situacao_Model();
        $dados = $model->lista();
        foreach($dados as $d){
            if($d->situacao == "FECHADO"){
                $valor = 0;
                $model = new CaixaDiario_Model();
                $retorno = $model->lista();
                foreach($retorno as $r){
                    if(date("Y-m-d", strtotime($r->created_at)) == date("Y-m-d", strtotime($d->dataCaixa))){
                        $valor = $valor + (float)$r->valor;
                    }
                }
                $tabela["data"][] = [
                    $d->id,
                    date("d/m/Y", strtotime($d->dataCaixa)),
                    "R$ ".$valor,
                    "<a data-role='hint' data-hint-text='Imprimir Relátorio' onclick='relatorio(\"$d->id\");' href='#'><img class='imagem-acao' src='/assets/images/imprimir.png'></a>"
                ];
            }            
        }      
        
        echo json_encode($tabela);
    }

    public static function saldoDiario(){
        $caixa_model = new CaixaDiario_Model();
        $valor = str_replace(".", ",", $caixa_model->saldoDia(date("Y-m-d")));
        //$valor = number_format($valor, 2, '.', '');
        return $valor;
    }

    public function fechar(){
        $dataAtual = date("Y-m-d");
        $caixa = new CaixaDiario_Situacao_Model();
        $count = $caixa->find("dataCaixa=:data", "data=$dataAtual")->count();
        if($caixa->fail()){
            Alert::error("Erro ao processar requisição!", $caixa->fail()->getMessage(), "/caixaDiario");
            die();
        }
        if($count == 0){
            $this->router->redirect("/caixaDiario");
        }
        $dados = $caixa->find("dataCaixa=:data", "data=$dataAtual")->fetch();
        if($dados->situacao == "FECHADO"){
            Alert::warning("Caixa do dia já foi fechado!", "Entre em contato com o administrador do sistema", "/dashboard");
            die();
        }
        Alert::question("Confirma saldo em caixa?", "R$ ".self::saldoDiario(), "/caixaDiario/fechar/sender", "/caixaDiario");
    }

    public function fecharSender(){
        $dataAtual = date("Y-m-d");
        $caixa = (new CaixaDiario_Situacao_Model())->find("dataCaixa=:data", "data=$dataAtual")->fetch();
        $caixa->situacao = "FECHADO";
        $caixa->save();
        if($caixa->fail()){
            Alert::error("Erro ao processar requisição!", $caixa->fail()->getMessage(), "/caixaDiario");
            die();
        }
        Alert::success("Caixa fechado!", "", "/relatorios/caixaDiario");
    }

    public function sangria(){
        $dados = (object) $_POST;
        $caixa = new CaixaDiario_Model();
        $caixa->inserir($dados->valor, $dados->descricao, "Saida");
        $caixa->save();
        if($caixa->fail()){
            $retorno = [
                "status" => false,
                "erro" => $caixa->fail()->getMessage()
            ];
        }else{
            $retorno = [
                "status" => true
            ];
        }

        echo json_encode($retorno);
    }

    public function abrir(){
        $caixaModel = new CaixaDiario_Situacao_Model();
        $caixaModel->salvar();
        $caixaDadosUltimo = new CaixaDiario_Situacao_Model();
        $dados = $caixaDadosUltimo->dadosUltimo();
        $cc = new CaixaDiario_Model();
        $data = date("Y-m-d", strtotime('-1 days', strtotime($dados->dataCaixa)));
        $valor = $cc->saldoDia($data);
        $valor = str_replace(".", ",", $valor);
        $cc->inserir($valor, "SALDO DIA ANTERIOR", "Entrada");
        $this->router->redirect("/caixaDiario");
    }

    public static function situacaoDiaria(){
        $caixaSituacao = new CaixaDiario_Situacao_Model();
        return $caixaSituacao->dadosData(date("Y-m-d"));
    }

    public static function dados($data){
        $caixaSituacao = new CaixaDiario_Situacao_Model();
        return $caixaSituacao->dados($data);
    }

    public static function lista(){
        $caixa = new CaixaDiario_Model();
        $lista = $caixa->find()->order("id ASC")->fetch(true);
        $tabela = null;
        $i = 0;
        foreach($lista as $d){
            if(date("Y-m-d") == date("Y-m-d", strtotime($d->created_at))){
                $valor = "R$ ".$d->valor;
                if($d->tipo == "Entrada"){
                    $valor = "<span style='color: darkgreen; font-weight: bold;'>$valor</span>";
                }else{
                    $valor = "<span style='color: red; font-weight: bold;'>$valor</span>";
                }
                if($i == 0){
                    $opcoes = "<a data-role='hint' disabled data-hint-text='Excluir' href='/caixa/excluir/$d->id'><img style='cursor: no-drop;' class='img-tabela' src='/src/img/excluir.png'></a>";
                }else{
                    $opcoes = "<a data-role='hint' data-hint-text='Excluir' href='/caixa/excluir/$d->id'><img class='img-tabela' src='/src/img/excluir.png'></a>";
                }
                $i++;
                $tabela .= "
                    <tr>
                        <td>$d->id</td>
                        <td>$d->descricao</td>
                        <td>$d->tipo</td>
                        <td>$valor</td>
                        <td>tewste</td>
                    </tr>
                ";
            }
        }
        return $tabela;
    }
}