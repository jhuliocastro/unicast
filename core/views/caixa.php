<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

    <style>
        .valorTotal {
            color: black;
            font-size: 26px;
            font-weight: bold;
        }

        .spanDesconto {
            color: black;
            font-size: 26px;
            font-weight: bold;
        }

        .numeroOrcamento{
            color: black;
            font-size: 26px;
            font-weight: bold;
        }

        #infos{
            float: right;
        }
    </style>

    <div class="pcoded-content">
        <div class="card">
            <form method="post" action="/pdv/orcamento/andamento" id="formEstoque">
                <div class="card-header" id="titulo">
                    CAIXA :: <?= $this->data["empresa"] ?>
                </div>
                <div class="card-body p-2">
                    <div class="card-block">
                        <div id="infos">
                            <span class="valorTotal">Valor Total: <span id="valorTotal"></span></span>
                        </div>
                        <button type="button" id="botaoProduto" class="shortcut primary">
                            <span class="badge">F1</span>
                            <span class="caption">Produto</span>
                            <span class="mif-search icon"></span>
                        </button>
                        <button type="button" id="botaoImportar" class="shortcut primary">
                            <span class="badge">F2</span>
                            <span class="caption">Importar</span>
                            <span class="mif-download icon"></span>
                        </button>
                        <button type="button" id="botaoQuantidade" class="shortcut primary">
                            <span class="badge">F3</span>
                            <span class="caption">Nova Venda</span>
                            <span class="mif-add icon"></span>
                        </button>
                        <button type="button" id="botaoFinalizar" class="shortcut primary">
                            <span class="badge">F4</span>
                            <span class="caption">Finalizar</span>
                            <span class="mif-clipboard icon"></span>
                        </button>
                        <button type="button" id="botaoFinalizar" class="shortcut primary">
                            <span class="badge">F5</span>
                            <span class="caption">Desconto</span>
                            <span class="mif-calculator icon"></span>
                        </button>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 15px;">
                                    <div class="form-group">
                                        <label>Código de Barras</label>
                                        <input id="codigoBarras" name="codigoBarras" autocomplete="off"
                                               data-role="input">
                                        <input type="hidden" name="quantidadeDados" id="quantidadeDados" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <table class="table" data-role="table" id="tabela">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>PRODUTO</th>
                        <th>QUANTIDADE</th>
                        <th>VALOR UNT</th>
                        <th>VALOR TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </form>
        </div>
    </div>
<!--
    <div class="dialog" id="importarOrcamento" data-role="dialog">
        <form method="post" id="formImportar">
            <div class="dialog-title">Selecione o orçamento</div>
            <div class="dialog-content">
               <select data-role="select" id="orcamento" name="orcamento">

               </select>
            </div>
            <div class="dialog-actions">
                <button type="button" class="button js-dialog-close">Cancelar</button>
                <button type="submit" class="button primary">Ok</button>
            </div>
        </form>
    </div>
-->
    <div id="importarOrcamento" title="Importar Orçamento">
        <form>
            <fieldset>
                <div class="form-group">
                    <label>Informe o número do pedido:</label>
                    <input type="number" name="numeroPedidoImportar" id="numeroPedidoImportar" data-role="input">
                </div>
                <hr>
                <table class="table" data-role="table" id="tabelaOrcamentos" data-show-search="false" data-show-rows-steps="false" data-rows="4">
                    <thead>
                    <tr>
                        <th>NÚMERO DO PEDIDO</th>
                        <th>CLIENTE</th>
                        <th>VALOR</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?= $this->data["orcamentos"] ?>
                    </tbody>
                </table>
                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>

    <div id="procurarProduto" title="Procurar Produto">
        <form>
            <fieldset>
                <div class="form-group">
                    <label>Informe o nome do produto:</label>
                    <input type="text" list="listaProdutos" name="procurarProdutosLista" id="procurarProdutosLista" data-role="input">
                    <datalist id="listaProdutos"><?= $this->data["produtos"]  ?></datalist>
                </div>
                <hr>
                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>

    <div id="dinheiro" title="Finalizar Venda">
        <form>
            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Valor Total da Compra</label>
                            <input type="text" readonly data-prepend="R$" name="valorTotalCompraDinheiro" id="valorTotalCompraDinheiro" data-role="input">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Valor Pago</label>
                            <input type="text" name="valorPagoDinheiro" data-prepend="R$" id="valorPagoDinheiro" data-role="input">
                        </div>
                    </div>
                </div>

                <hr>
                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>

    <div id="finalizarVenda" title="Finalizar Venda">
        <form>
            <fieldset>
                <div class="form-group">
                    <label>Informe um método de pagamento: (Digite o número correspondente no teclado)</label>
                    <ul data-role="list-view">
                        <li>1 - DINHEIRO</li>
                        <li>2 - DÉBITO/CRÉDITO</li>
                        <li>3 - CREDIÁRIO</li>
                        <li>4 - CRÉDITO LOJA</li>
                        <li>5 - PIX</li>
                        <li>6 - TED/DOC</li>
                        <a href="#"></a>
                    </ul>
                </div>
                <hr>
                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>

    <div id="janelaDesconto" title="Aplicar Desconto">
        <form>
            <fieldset>
                <div class="form-group">
                    <label>Informe o valor</label>
                    <input type="text" class="" id="valorDesconto" name="valorDesconto" data-role="input">
                </div>
                <hr>
                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>

<?= $this->start("scripts"); ?>
    <script>
        var quantidade = 1;
        var valorTotalOrcamento = 0;
        var valorDesconto = 0;
        var valorCaixa = 0;

        $(function() {
            $("#valorPagoDinheiro").mask('#.##0,00', {reverse: true});
            $("#valorDesconto").mask('#.##0,00', {reverse: true});

            var dialog = $("#importarOrcamento").dialog({
                autoOpen: false,
                width: 800,
                buttons: {
                    "Importar": formImportar
                }
            });

            var form = dialog.find( "form" ).on( "submit", function( event ) {
                event.preventDefault();
                formImportar();
            });

            var dialog1 = $("#procurarProduto").dialog({
                autoOpen: false,
                width: 800,
                buttons: {
                    "Confirmar": formProcurar
                }
            });

            var form1 = dialog1.find( "form" ).on( "submit", function( event ) {
                event.preventDefault();
                formProcurar();
            });

            var dialog2 = $("#finalizarVenda").dialog({
                autoOpen: false,
                width: 800
            });

            var form2 = dialog2.find( "form" ).on( "submit", function( event ) {
                event.preventDefault();
                formProcurar();
            });

            var dialog3 = $("#dinheiro").dialog({
                autoOpen: false,
                width: 800,
                buttons: {
                    "Finalizar": finalizarVenda
                }
            });

            var form3 = dialog3.find( "form" ).on( "submit", function( event ) {
                event.preventDefault();
                finalizarVenda();
            });

            //JANELA DE DESCONTO
            var dialog4 = $("#janelaDesconto").dialog({
                autoOpen: false,
                width: 800,
                buttons: {
                    "Aplicar": desconto
                }
            });

            var form4 = dialog4.find( "form" ).on( "submit", function( event ) {
                event.preventDefault();
                desconto();
            });
        });

        function desconto(){
            valorDesconto = $("#valorDesconto").val();
            valorDesconto = valorDesconto.replace(",", ".");
   
            $("#spanDesconto").html("R$ " + valorDesconto.replace(".", ","));

            $("#janelaDesconto").dialog('close');

            $("#valorDesconto").val("");

            Metro.toast.create("Desconto Aplicado!", null, null, "success");
        }

        function finalizarVenda(){
            let valorPagoDinheiro = $("#valorPagoDinheiro").val();
            let valorPedido = $("#valorTotalCompraDinheiro").val();

            if(valorPagoDinheiro == ""){
                Metro.toast.create("Informe o valor pago!", null, null, "error");
            }else{
                $.ajax({
                    url: "/pdv/caixa/finalizar/dinheiro",
                    type: 'post',
                    dataType: 'html',
                    data: {
                        valorPagoPedido: valorPagoDinheiro,
                        valorPedido: valorCaixa,
                        desconto: valorDesconto
                    },
                    beforeSend: function () {
                        $("#resultado").html("ENVIANDO...");
                    }
                    })
                    .done(function (retorno) {
                        console.log(retorno);
                        if(retorno == "true"){
                            window.location.href = "/pdv/caixa/finalizar/dinheiro/true";
                        }else{
                            window.location.href = "/pdv/caixa/finalizar/dinheiro/false";
                        }
                    })
                    .fail(function (jqXHR, textStatus, msg) {
                        console.log(msg);

                    });
            }
        }

        function formProcurar(){
            let produto = $("#procurarProdutosLista").val();
            $.ajax({
                url: "/pdv/caixa/pesquisar/produto",
                type: 'post',
                dataType: 'html',
                data: {
                    produto: produto
                },
                beforeSend: function () {
                    $("#resultado").html("ENVIANDO...");
                }
            })
                .done(function (retorno) {
                    console.log(retorno);
                    if(retorno == "nao existe"){
                        var notify = Metro.notify;
                        notify.create("Produto não existe na base de dados!", "Erro", {
                            cls: "alert"
                        });
                        $("#procurarProdutosLista").val("");
                        $("#procurarProduto").dialog('close');
                    }else{
                        $("#codigoBarras").val(retorno);
                        $("#procurarProdutosLista").val("");
                        $("#procurarProduto").dialog('close');
                        $("#codigoBarras").focus();
                    }
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

        function infos(numeroPedido){
            $.ajax({
                url: "/pdv/caixa/valorTotal",
                type: 'post',
                dataType: 'html',
                data: {
                    orcamento: numeroPedido
                },
                beforeSend: function () {
                    $("#resultado").html("ENVIANDO...");
                }
            })
                .done(function (valorTotal) {
                    console.log(valorTotal);
                    $("#infos").html("<span class='numeroOrcamento'>Orçamento: <span id='numeroOrcamento'>" + numeroPedido + "</span></span>" +
                        "<br/>" +
                        "<span class='valorTotal'>Valor Total: <span id='valorTotal'>R$ " + valorTotal + "</span></span><br/>" +
                        "<span class='spanDesconto'>Desconto: <span id='spanDesconto'>R$ 0,00</span></span>");
                    $("#valorTotalCompraDinheiro").val(valorTotal);
                    valorTotalOrcamento = valorTotal;
                })
                .fail(function (jqXHR, textStatus, msg) {
                    console.log(msg);
                });
        }

        function formImportar(){
            let numeroPedido = $("#numeroPedidoImportar").val();
            if(numeroPedido === ""){
                Metro.toast.create("Informe o número do pedido!", null, null, "alert");
            }else{
                $.ajax({
                    url: "/pdv/caixa/importar",
                    type: 'post',
                    dataType: 'html',
                    data: {
                        orcamento: numeroPedido
                    },
                    beforeSend: function () {
                        $("#resultado").html("ENVIANDO...");
                    }
                })
                    .done(function (produto) {
                        console.log(produto);
                        if(produto === "nao existe"){
                            Metro.toast.create("Orçamento não encontrado!", null, null, "alert");
                            $("#tabela>tbody").html("");
                            $("#infos").html("");
                            $("#numeroPedidoImportar").val("");
                            $("#numeroPedidoImportar").focus();
                        }else if(produto === "em branco"){
                            Metro.toast.create("Orçamento em branco!", null, null, "alert");
                            $("#tabela>tbody").html("");
                            $("#infos").html("");
                            $("#numeroPedidoImportar").val("");
                            $("#numeroPedidoImportar").focus();
                        }else{
                            $("#tabela>tbody").html("");
                            $("#tabela>tbody").prepend(produto);
                            $("#numeroPedidoImportar").val("");
                            $("#importarOrcamento").dialog('close');
                            Metro.toast.create("Orçamento importado!", null, null, "info");
                            infos(numeroPedido);                            
                        }

                    })
                    .fail(function (jqXHR, textStatus, msg) {
                        console.log(msg);
                        var notify = Metro.notify;
                        notify.create("Produto não cadastrado ou erro na pesquisa!", "Erro", {
                            cls: "alert"
                        });
                        $("#nomeProduto").val("");
                    });

                $.ajax({
                    url: "/pdv/orcamento/dados",
                    type: 'post',
                    dataType: 'html',
                    data: {
                        orcamento: numeroPedido
                    },
                    beforeSend: function () {
                        $("#resultado").html("ENVIANDO...");
                    }
                })
                    .done(function (produto) {
                        console.log(produto);
                        $("#titulo").html("CAIXA :: <?= $this->data["empresa"] ?> :: " + produto);
                    })
                    .fail(function (jqXHR, textStatus, msg) {
                        console.log(msg);
                    });
            }
        }

        $(document).ready(function () {
            $("#codigoBarrasCaixa").focus();

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


        //BOTAO PROCURAR PRODUTO
        $('#codigoBarras').on('keydown', null, 'f1', function () {
            $("#procurarProduto").dialog('open');
            $("#nomeProduto").focus();
            return false;
        });

        $(document).on('keydown', null, 'f1', function () {
            $("#procurarProduto").dialog('open');
            $("#nomeProduto").focus();
            return false;
        });

        //BOTAO IMPORTAR ORCAMENTO
        $('#codigoBarras').on('keydown', null, 'f2', function () {
            $("#importarOrcamento").dialog('open');
            return false;
        });

        $(document).on('keydown', null, 'f2', function () {
            $("#importarOrcamento").dialog('open');
            return false;
        });

        $("#botaoImportar").click(function(){
            $("#importarOrcamento").dialog('open');
        });


        //BOTAO FINALIZAR VENDA
        $('#codigoBarras').on('keydown', null, 'f4', function () {
            $("#finalizarVenda").dialog('open');
            return false;
        });

        $(document).on('keydown', null, 'f4', function () {
            $("#finalizarVenda").dialog('open');
            return false;
        });

        //BOTAO DESCONTO
        $('#codigoBarras').on('keydown', null, 'f5', function () {
            $("#janelaDesconto").dialog('open');
            return false;
        });

        $(document).on('keydown', null, 'f5', function () {
            $("#janelaDesconto").dialog('open');
            return false;
        });

        $("#botaoFinalizar").click(function(){
            $("#finalizarVenda").dialog('open');
        });

        //OPCOES DE PAGAMENTO
        $("#finalizarVenda").on('keydown', null, '1', function () {
            //DINHEIRO
            $("#finalizarVenda").dialog('close');
            $("#dinheiro").dialog('open');
            $("#valorPagoDinheiro").focus();

            valorCaixa = valorTotalOrcamento;
            valorTotalOrcamento = valorTotalOrcamento.replace(",", ".");
            valorDesconto = valorDesconto.replace(",", ".");

            valorTotalOrcamento = valorTotalOrcamento - valorDesconto;
            valorTotalOrcamento = valorTotalOrcamento.toFixed(2);

            valorTotalOrcamento = valorTotalOrcamento.replace(".", ",");

            $("#valorTotalCompraDinheiro").val(valorTotalOrcamento);

        });

        $("#finalizarVenda").on('keydown', null, '2', function () {
            alert('tesate');
        });

        $("#finalizarVenda").on('keydown', null, '3', function () {
            alert('tesate');
        });

        $("#finalizarVenda").on('keydown', null, '4', function () {
            alert('tesate');
        });

        $("#finalizarVenda").on('keydown', null, '5', function () {
            alert('tesate');
        });

        $("#finalizarVenda").on('keydown', null, '6', function () {
            alert('tesate');
        });

    </script>
<?= $this->end("scripts"); ?>