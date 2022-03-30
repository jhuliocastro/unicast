<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<style>
    .valorTotal{
        float: right;
        color: darkgreen;
        font-size: 26px;
        font-weight: bold;
    }
</style>

<div class="pcoded-content">
    <div class="card">
        <form method="post" id="formEstoque">
            <div class="card-header">
                Novo Orçamento :: <?= $this->data["empresa"] ?> :: <?= $this->data["cliente"] ?>
            </div>
            <div class="card-body p-2">
                <div class="card-block">
                    <span class="valorTotal">Valor Total: <span id="valorTotal"></span></span>
                    <button type="button" class="shortcut primary">
                        <span class="badge">F1</span>
                        <span class="caption">Produto</span>
                        <span class="mif-search icon"></span>
                    </button>
                    <button type="button" id="botaoQuantidade" class="shortcut primary">
                        <span class="badge">F2</span>
                        <span class="caption">Quantidade</span>
                        <span class="mif-info icon"></span>
                    </button>
                    <button type="button" id="botaoFinalizar" class="shortcut primary">
                        <span class="badge">F3</span>
                        <span class="caption">Finalizar</span>
                        <span class="mif-clipboard icon"></span>
                    </button>
                    <button type="button" id="botaoFinalizar" class="shortcut primary">
                        <span class="badge">F4</span>
                        <span class="caption">Excluir<br/> Produto</span>
                        <span class="mif-cancel icon"></span>
                    </button>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" style="margin-top: 15px;">
                                <div class="form-group">
                                    <label>Código de Barras</label>
                                    <input id="codigoBarras" name="codigoBarras" autocomplete="off" data-role="input">
                                    <input type="hidden" name="quantidadeDados" id="quantidadeDados" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            </form>
            <table id="tabela" class="display compact" style="width: 100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>PRODUTO</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR UNT</th>
                    <th>VALOR TOTAL</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        
    </div>
</div>

<div class="dialog" id="janelaQuantidade" data-role="dialog">
    <form method="post" id="formQuantidade">
        <div class="dialog-title">Insira a quantidade desejada</div>
        <div class="dialog-content">
            <input type="number" id="quantidadeProxProduto" name="quantidadeProxProduto" data-role="input">
        </div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancelar</button>
            <button type="submit" class="button primary">Ok</button>
        </div>
    </form>
</div>

<div id="janelaExcluirProduto" title="Excluir Produto">
    <form>
        <fieldset>
            <div class="form-group">
                <label>Informe o ID do produto:</label>
                <input type="text" name="idExcluirProduto" id="idExcluirProduto" data-role="input">
            </div>
            <hr>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>

<div class="dialog" id="janelaProduto" data-role="dialog">
    <form method="post" id="formProduto">
        <div class="dialog-title">Digite o nome do produto</div>
        <div class="dialog-content">
            <input autocomplete="off" type="search" list="listProdutos" id="nomeProduto" name="nomeProduto" data-role="input">
            <datalist id="listProdutos"><?= $this->data["produtos"] ?></datalist>
        </div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancelar</button>
            <button type="submit" class="button primary">Ok</button>
        </div>
    </form>
</div>

<?= $this->start("scripts"); ?>
<script>
    var quantidade = 1;

    <?php
    if($this->data["valorTotalJS"] == null){
        echo "var valorTotalOrcamento = 0;";
    }else{
        echo "valorTotalOrcamento = ".$this->data["valorTotalJS"].";";
    }
    ?>

    valorTotalOrcamento = (Math.round(valorTotalOrcamento * 100) / 100).toFixed(2);
    $("#valorTotal").html("R$ "+valorTotalOrcamento);

    $('#codigoBarras').on('keydown', null, 'f1', function () {
        Metro.dialog.open("#janelaProduto");
        $("#nomeProduto").focus();
        return false;
    });

    $(document).on('keydown', null, 'f1', function () {
        Metro.dialog.open("#janelaProduto");
        $("#nomeProduto").focus();
        return false;
    });

    $('#codigoBarras').on('keydown', null, 'f2', function () {
        Metro.dialog.open("#janelaQuantidade");
        $("#quantidadeProxProduto").focus();
        return false;
    });

    $(document).on('keydown', null, 'f2', function () {
        Metro.dialog.open("#janelaQuantidade");
        $("#quantidadeProxProduto").focus();
        return false;
    });

    $(document).on('keydown', null, 'f3', function () {
        window.location.href = "/pdv/orcamento/finalizar";
        return false;
    });

    $("#codigoBarras").on('keydown', null, 'f3', function () {
        window.location.href = "/pdv/orcamento/finalizar";
        return false;
    });

    $('#codigoBarras').on('keydown', null, 'f4', function () {
        $("#janelaExcluirProduto").dialog('open');
        $("#idProdutoExcluir").focus();
        return false;
    });

    $(document).on('keydown', null, 'f4', function () {
        $("#janelaExcluirProduto").dialog('open');
        $("#idProdutoExcluir").focus();
        return false;
    });

    $('#quantidadeProxProduto').on('keydown', null, 'esc', function () {
        Metro.dialog.close("#janelaQuantidade");
        $("#codigoBarras").focus();
        return false;
    });

    $('#nomeProduto').on('keydown', null, 'esc', function () {
        Metro.dialog.close("#janelaProduto");
        $("#nomeProduto").val("");
        $("#codigoBarras").focus();
        return false;
    });

    $("#botaoQuantidade").click(function(){
        Metro.dialog.open("#janelaQuantidade");
        $("#quantidadeProxProduto").focus();
        return false;
    });

    $("#formQuantidade").submit(function(event){
        event.preventDefault();
        quantidade = $("#quantidadeProxProduto").val();
        $("#quantidadeDados").val(quantidade);
        $("#quantidadeProxProduto").val("");
        $("#codigoBarras").focus();
    });

    var dialog = $("#janelaExcluirProduto").dialog({
        autoOpen: false,
        width: 800
    });

    var form = dialog.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        excluirProduto();
    });

    function excluirProduto(){
        $("#janelaExcluirProduto").dialog('close');
        let produto = $("#idExcluirProduto").val();
        $("#idExcluirProduto").val("");
        $.ajax({
            url: "/pdv/orcamento/excluir/produto",
            type: 'post',
            dataType: "json",
            data: {
                produto: produto
            },
            beforeSend: function () {
                $("#resultado").html("ENVIANDO...");
            }
        })
            .done(function (produto) {
                console.log(produto);
                if(produto.status == true){
                    Metro.toast.create("Produto Excluído!", null, null, "info");
                }else{
                    console.log(produto.erro);
                    Metro.toast.create("Erro! Contate o administrador do sistema.", null, null, "alert");
                }

                tabela.ajax.reload();

                $("#nomeProduto").val("");
                $("#codigoBarras").focus();
            })
            .fail(function (jqXHR, textStatus, msg) {
                console.log(msg);
                var notify = Metro.notify;
                notify.create("Produto não cadastrado ou erro na pesquisa!", "Erro", {
                    cls: "alert"
                });
                $("#nomeProduto").val("");
            });
    }

    $("#formProduto").submit(function(event){
       event.preventDefault();
        $.ajax({
            url: "/produtos/pesquisar",
            type: 'post',
            dataType: "JSON",
            data: {
                produto: $("#nomeProduto").val()
            },
            beforeSend: function () {
                $("#resultado").html("ENVIANDO...");
            }
        })
            .done(function (produto) {
                console.log(produto);
                if(produto.codigoBarras !== null){
                    $("#codigoBarras").val(produto.codigoBarras);
                }else{
                    var notify = Metro.notify;
                    notify.create("Erro ao buscar código de barras!", "Erro", {
                        cls: "alert"
                    });
                }

                $("#nomeProduto").val("");
                $("#codigoBarras").focus();
            })
            .fail(function (jqXHR, textStatus, msg) {
                console.log(msg);
                var notify = Metro.notify;
                notify.create("Produto não cadastrado ou erro na pesquisa!", "Erro", {
                    cls: "alert"
                });
                $("#nomeProduto").val("");
            });

        $("#nomeProduto").val();
    });

    $(document).ready(function () {
        $("#codigoBarras").focus();

        var tabela = $('#tabela').DataTable({
            "paging": false,
            'ajax': '/pdv/orcamento/aberto/relacao/<?= $this->data["orcamento"] ?>',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $("#formEstoque").submit(function (event) {
            event.preventDefault();
            let codigoBarras = $("#codigoBarras").val();
            $.ajax({
                url: "/produtos/dados",
                type: 'post',
                dataType: "JSON",
                data: {
                    codigoBarras: codigoBarras,
                    quantidadeDados: $("#quantidadeDados").val()
                },
                beforeSend: function () {
                    $("#resultado").html("ENVIANDO...");
                }
            })
                .done(function (produto) {
                    console.log(produto);
                    let valorUN = Number(produto.valor).toFixed(2);
                    let valorTotal = valorUN * quantidade;
                    valorTotalOrcamento = parseFloat(valorTotalOrcamento);
                    console.log(valorTotalOrcamento);
                    console.log(valorTotal);
                    valorTotalOrcamento = valorTotalOrcamento + valorTotal;
                    valorTotalOrcamento = valorTotalOrcamento.toFixed(2);

                    valorTotal = valorTotal.toFixed(2);
                    valorTotal = "R$ " + valorTotal;
                    valorUN = "R$ " + valorUN;
                    valorTotal = valorTotal.replace(".", ",");
                    valorUN = valorUN.replace(".", ",");
                    $("#tabela>tbody").prepend("<tr>" +
                        "<td>" + produto.id + "</td>" +
                        "<td>" + produto.produto + "</td>" +
                        "<td>" + quantidade + "</td>" +
                        "<td>" + valorUN + "</td>" +
                        "<td>" + valorTotal + "</td>" +
                        "</tr>");

                    quantidade = 1;//VOLTA A QUANTIDADE PARA 1
                    $("#quantidadeDados").val(quantidade);
                    $("#codigoBarras").val("");


                    $("#valorTotal").html("R$ " + valorTotalOrcamento);
                    $("#valorTotalCompraDinheiro").val(valorTotalOrcamento);

                })
                .fail(function (jqXHR, textStatus, msg) {
                    console.log(msg);
                    var notify = Metro.notify;
                    notify.create("Produto não cadastrado ou erro no cadastro!", "Erro", {
                        cls: "alert"
                    });
                    $("#codigoBarras").val("");
                });
        });
    });
</script>
<?= $this->end("scripts"); ?>
