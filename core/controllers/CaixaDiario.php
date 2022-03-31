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

    public function excluir($data){
        extract($data);
        $caixa = new CaixaDiario_Model();
        $dados = $caixa->findById($id);
        parent::alertaQuestion("Confirma exclusão do lançamento?", $dados->descricao, "/caixa/excluir/sender/$id", "/caixa");
    }

    public function relatorioSelecionar(){
        parent::render("caixa", "relatorioSelecionar", []);
    }

    public function tabela(){
        $caixa = new CaixaDiario_Model();
        $lista = $caixa->find()->order("id ASC")->fetch(true);
        foreach($lista as $d){
            if(date("Y-m-d") == date("Y-m-d", strtotime($d->created_at))){
                $valor = "R$ ".$d->valor;
                if($d->tipo == "Entrada"){
                    $valor = "<span style='color: darkgreen; font-weight: bold;'>$valor</span>";
                }else{
                    $valor = "<span style='color: red; font-weight: bold;'>$valor</span>";
                }
                $tabela["data"][] = [
                     $d->id,
                     $d->descricao,
                     $d->tipo,
                     $valor
                ];
            }
        }

        echo json_encode($tabela);
    }

    public function excluirSender($data){
        extract($data);
        $caixa = (new CaixaDiario_Model())->findById($id);
        $caixa->destroy();
        if($caixa->fail()){
            parent::alerta("error", "Erro ao processar requisição!", $caixa->fail()->getMessage(), "/caixa");
            die();
        }
        parent::alerta("success", "Lançamento excluído com sucesso!", "", "/caixa");
    }

    public function relatorioDiario($dados){
        parent::render("caixa", "relatorioCaixaDiario", [
            "data" => $dados["data"],
            "dataBR" => date("d/m/Y", strtotime($dados["data"]))
        ]);
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
        Alert::success("Caixa fechado!", "", "/dashboard");
    }

    public function incluir(){
        $dataAtual = date("Y-m-d");
        $caixa = new CaixaDiario_Situacao_Model();
        $count = $caixa->find("dataCaixa=:data", "data=$dataAtual")->count();
        if($count == 0){
            $this->router->redirect("/caixa");
        }
        $dados = $caixa->find("dataCaixa=:data", "data=$dataAtual")->fetch();
        if($dados->situacao == "FECHADO"){
            parent::alerta("warning", "Caixa do dia já foi fechado!", "Entre em contato com o administrador do sistema", "/painel");
            die();
        }
        parent::render("caixa", "novoLancamento", []);
    }

    public function incluirSender(){
        $dados = (object) $_POST;
        $caixa = new CaixaDiario_Model();
        $caixa->descricao = $dados->descricao;
        $caixa->tipo = $dados->tipo;
        $caixa->valor = $dados->valor;
        $caixa->save();
        if($caixa->fail()){
            parent::alerta("error", "Erro ao processar requisição!", $caixa->fail()->getMessage(), "/caixa/incluir");
            die();
        }
        parent::alerta("success", "Lançamento incluído com sucesso!", "", "/caixa");
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
                        <td>
                            $opcoes
                        </td>
                    </tr>
                ";
            }
        }
        return $tabela;
    }
 /*
    public function listaDiario($data){
        $arquivos = new CaixaDiario_Model();
        $listaArquivos = $arquivos->lista();
        $dados["data"] = array();
        for($i=0;$i<sizeof($listaArquivos);$i++){
            if(date("Y-m-d", strtotime($data["data"])) == date("Y-m-d", strtotime($listaArquivos[$i]->created_at))){
                $id = $listaArquivos[$i]->id;
                $valor = "R$ ".$listaArquivos[$i]->valor;
                if($listaArquivos[$i]->tipo == "Entrada"){
                    $valor = "<span style='color: darkgreen; font-weight: bold;'>$valor</span>";
                }else{
                    $valor = "<span style='color: red; font-weight: bold;'>$valor</span>";
                }
                $provisorio = [
                    $t,
                    $id,
                    $listaArquivos[$i]->descricao,
                    $listaArquivos[$i]->tipo,
                    $valor
                ];
                $dados["data"][] = $provisorio;
            }
        }
        echo json_encode($dados);
    }*/
}