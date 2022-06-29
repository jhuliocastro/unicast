<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>
<style>
    #div1{
        background-color: #f5f6f7;
        border-radius: 5px;
        min-height: 100%;
        height: 100%;
        margin-top: 21px;
    }

    .opcoes{
        background-color: #ebebeb;
        text-align: center;
        font-weight: bold;
        border: 1px solid black;
    }

    .cs{
        border: 2px solid black;
        border-radius: 10px;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        padding: 10px;
        margin: 10px;
    }

    .acoes{
        text-align: center;
        font-weight: bold;
    }
</style>

<div class="pcoded-content">
    <div class="card">
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-7 cs" id="produtoAtual">
                            INICIANDO NOVO ORÇAMENTO
                        </div>
                        <div class="col-md-2 cs" id="quantidadeProdutoAtual">
                            0 UN
                        </div>
                        <div class="col-md-2 cs" id="valorProdutoAtual">
                            R$ 0,00
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" id="div1">
                            <br/>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <select class="form-control" id="cliente" name="cliente">
                                        <?= $this->data["clientes"] ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <form id="formProdutoCodigo" method="post">
                                        <input type="text" class="form-control" onkeypress="return somenteNumeros(event)" id="produto" name="produto" placeholder="Procute o produto pelo código, nome ou código de barras">
                                    </form>
                                </div>
                            </div>
                            <div class="row" style="background-color: lightblue;">
                                <div class="col-md-3">
                                    Total de Itens
                                </div>
                                <div class="col-md-3" style="text-align: right; border-right: 1px solid white;">
                                    <span id="totalItens">0</span>
                                </div>
                                <div class="col-md-3">
                                    Desconto
                                </div>
                                <div class="col-md-3" style="text-align: right;">
                                    <span id="desconto">R$ 0,00</span>
                                </div>
                            </div>
                            <div class="row" style="background-color: lightgreen;">
                                <div class="col-md-6">
                                    Valor Total
                                </div>
                                <div class="col-md-6" style="text-align: right;">
                                    <span style="font-weight: bold; font-size: 20px;" id="valorTotal">R$ 0,00</span>
                                </div>
                            </div>
                            <br/>
                            <div class="acoes">
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-secondary" role="alert">
                                        F4 - QUANTIDADE
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="alert alert-secondary" role="alert">
                                        F5 - CANCELAR ITEM
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-secondary" role="alert">
                                        F6 - FINALIZAR
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-8">
                            <table id="tabela" class="display compact" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PRODUTO</th>
                                        <th>QUANTIDADE</th>
                                        <th>VALOR UN</th>
                                        <th>VALOR TOTAL</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- START DIALOG PROCURAR PRODUTO -->
<div id="procurarProduto" title="Procurar Produto">
    <form>
        <fieldset>
            <div class="form-group">
                <label>Informe o nome do produto:</label>
                <input type="text" onkeyup="procurarProdutoLimpo()" list="listaProdutos" name="procurarProdutosLista" id="procurarProdutosLista" class="form-control form-control-sm">
                <datalist id="listaProdutos"><?= $this->data["listaProdutos"]  ?></datalist>
            </div>
            <hr>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>
<!--INICIO DIALOG QUANTIDADE PRODUTO -->
<div id="quantidadeProduto" title="Quantidade Produto">
    <form>
        <fieldset>
            <div class="form-group">
                <label>Informe a quantidade do produto:</label>
                <input type="number" name="quantidadeProxProduto" id="quantidadeProxProduto" class="form-control form-control-sm">
            </div>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>
<!--INICIO DIALOG CANCELAR PRODUTO -->
<div id="cancelarProduto" title="Cancelar Produto">
    <form>
        <fieldset>
            <div class="form-group">
                <label>Informe o ID do produto:</label>
                <input type="number" name="idCancelarProduto" id="idCancelarProduto" class="form-control form-control-sm">
            </div>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>

<script>
    var quantidade = 1;
    var valorTotalCompra = 0;
    var valorAposDesconto = 0;
    var desconto = 0;
    var quantidadeGeral = 0;
    var lista = {};
    var troco = 0;
    var valorRestante = 0;
    var valorContagemPagamento = 0;
    var orcamento = null;
    var md5 = '<?= $this->data["md5"] ?>';

    var audio = new Audio("/assets/sons/beep.mp3");

    var tabela = $('#tabela').DataTable({
        "paging": false,
        'ajax': '/temp/' + md5 + '.json',
        "order": [],
        'searching': false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
    });

    var dialogProcurarProduto = $("#procurarProduto").dialog({
        autoOpen: false,
        width: 800,
        modal: true,
        buttons: {
            "Confirmar": procurarProduto
        }
    });

    var formProcurarProduto = dialogProcurarProduto.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        procurarProduto();
    });

    var dialogQuantidadeProduto = $("#quantidadeProduto").dialog({
        autoOpen: false,
        width: 300,
        modal: true,
        buttons: {
            "Confirmar": quantidadeProduto
        }
    });

    var formQuantidadeProduto = dialogQuantidadeProduto.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        quantidadeProduto();
    });

    var dialogCancelarProduto = $("#cancelarProduto").dialog({
        autoOpen: false,
        width: 300,
        modal: true,
        buttons: {
            "Confirmar": cancelarProduto
        }
    });

    var formCancelarProduto = dialogCancelarProduto.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        cancelarProduto();
    });


    function cancelarProduto(){
        let id = $("#idCancelarProduto").val();

        $.ajax({
                        url: "/pdv/caixa/cancelar/item",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            idProduto: id,
                            md5: md5
                        }
                    })
                        .done(function (retorno) {
                            console.log(retorno);
                            dialogCancelarProduto.dialog('close');
                            $("#idCancelarProduto").val("");
                            
                            var notify = Metro.notify;
                            notify.create("Produto " + id + " excluído!", "", {
                                cls: "success"
                            });

                            retorno.valorTotal = retorno.valorTotal.replace('R$ ', '');
                            valorTotalCompra = valorTotalCompra - retorno.valorTotal;
                            $("#valorTotal").html("R$ " + Number(valorTotalCompra).toFixed(2));

                            quantidadeGeral = quantidadeGeral - retorno.quantidade;
                            $("#totalItens").html(quantidadeGeral);
                        })
                        .fail(function (jqXHR, textStatus, msg) {
                            console.log(msg);
                        });
    }

    function quantidadeProduto(){
        quantidade = $("#quantidadeProxProduto").val();
        dialogQuantidadeProduto.dialog('close');
        $("#quantidadeProxProduto").val("");
        $("#produto").focus();
    }


    $("#formProdutoCodigo").submit(function(){
        let codigoBarras = $("#produto").val();

        if(codigoBarras !== ""){

        $.ajax({
            url: "/produtos/dados",
            type: 'post',
            dataType: 'json',
            data: {
                codigoBarras: codigoBarras
            }
        })
            .done(function (retorno) {
                console.log(retorno);
                $("#procurarProdutosLista").val("");

                if(retorno.id !== null){
                    if(retorno.status === false){
                    var notify = Metro.notify;
                    notify.create(retorno.erro, "Erro", {
                        cls: "alert"
                    });
                    $("#produto").val("");
                }else{
                    let valorUN = Number(retorno.valor).toFixed(2);
                    console.log(valorUN);
                    let valorTotal = valorUN * quantidade;

                    $.ajax({
                        url: "/pdv/orcamento/md5",
                        type: 'post',
                        dataType: 'html',
                        data: {
                            idProduto: retorno.id,
                            nomeProduto: retorno.produto,
                            quantidade: quantidade,
                            valorUN: valorUN,
                            valorTotal: Number(valorTotal).toFixed(2),
                            md5: md5,
                            valorTotalCompra: valorTotalCompra
                        }
                    })
                        .done(function (retorno) {
                            console.log(retorno);
                        })
                        .fail(function (jqXHR, textStatus, msg) {
                            console.log(msg);
                        });


                    $("#produto").val("");
                    $("#produto").focus();

                    quantidadeGeral = quantidadeGeral + parseInt(quantidade);

                    $("#totalItens").html(quantidadeGeral);

                    console.log(retorno);

                    $("#produtoAtual").html(retorno.produto);
                    $("#quantidadeProdutoAtual").html(quantidade + " " + retorno.unidadeMedida);
                    $("#valorProdutoAtual").html("R$ "+ Number(valorTotal).toFixed(2));

                    quantidade = 1;

                    valorTotalCompra = valorTotalCompra + valorTotal;

                    $("#valorTotal").html("R$ "+ valorTotalCompra.toFixed(2));

                    audio.play();

                }
                }else{
                    var notify = Metro.notify;
                    notify.create("Produto não encontrado! Verique o log.", "Erro", {
                        cls: "alert"
                    });
                }

                

            })
            .fail(function (jqXHR, textStatus, msg) {
                console.log(msg);
                var notify = Metro.notify;
                notify.create("Erro ao buscar dados do produto! Verique o log.", "Erro", {
                    cls: "alert"
                });
                $("#produto").val("");
            });

        }

        return false;
    });

    $("#formQuantidade").submit(function(event){
        event.preventDefault();
        quantidade = $("#quantidadeProxProduto").val();
        $("#quantidadeProxProduto").val("");
        $("#produto").focus();
    });

    function procurarProduto(){
        let produto = $("#procurarProdutosLista").val();
        $.ajax({
            url: "/pdv/caixa/pesquisar/produto",
            type: 'post',
            dataType: 'json',
            data: {
                produto: produto
            }
        })
            .done(function (retorno) {
                console.log(retorno);
                $("#procurarProdutosLista").val("");
                dialogProcurarProduto.dialog('close');
                if(retorno.status === false){
                    var notify = Metro.notify;
                    notify.create(retorno.erro, "Erro", {
                        cls: "alert"
                    });
                }else{
                    $("#produto").val(retorno.codigoBarras);
                    $("#formProdutoCodigo").submit();
                }

            })
            .fail(function (jqXHR, textStatus, msg) {
                console.log(msg);
                var notify = Metro.notify;
                notify.create("Erro ao buscar dados do produto! Verique o log.", "Erro", {
                    cls: "alert"
                });
            });
    }

    function somenteNumeros(e) {
        var charCode = e.charCode ? e.charCode : e.keyCode;
        // charCode 8 = backspace
        // charCode 9 = tab
        if (charCode !== 8 && charCode !== 9 && charCode !== 13) {
            // charCode 48 equivale a 0
            // charCode 57 equivale a 9
            console.log(charCode)
            if (charCode < 48 || charCode > 57) {
                $("#produto").val("");
                dialogProcurarProduto.dialog('open');
                $("#procurarProdutosLista").val(e.key);
                $("#procurarProdutoLista").focus();
                return false;
            }
        }
    }

    function procurarProdutoLimpo(){
        let v = $("#procurarProdutosLista").val();
        if(v === ""){
            dialogProcurarProduto.dialog('close');
        }
    }

    //ATALHOS
   //INICIO ATALHO INFORMA QUANTIDADE PRODUTO
    $('#produto').on('keydown', null, 'f4', function () {
        dialogQuantidadeProduto.dialog('open');
        $("#quantidadeProxProduto").focus();
        return false;
    });

    $(document).on('keydown', null, 'f4', function () {
        dialogQuantidadeProduto.dialog('open');
        $("#quantidadeProxProduto").focus();
        return false;
    });
    //FIM ATALHO INFORMA QUANTIDADE PRODUTO

    //INICIO ATALHO CANCELAMENTO DE ITEM
    $('#produto').on('keydown', null, 'f5', function () {
        dialogCancelarProduto.dialog('open');
        return false;
    });

    $(document).on('keydown', null, 'f5', function () {
        dialogCancelarProduto.dialog('open');
        return false;
    });
    //FIM ATALHO CANCELAMENTO DE ITEM

</script>

<!-- END DIALOG PROCURAR PRODUTO -->
<script>
    $(document).ready(function(){
        $("#cliente").select2();

        $("#totalItens").html(quantidade);
        $("#produto").focus();

        setInterval( function () {
            tabela.ajax.reload();
        }, 300 );
    });
</script>