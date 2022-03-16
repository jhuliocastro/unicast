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
                <div class="card-header">
                    CAIXA :: <?= $this->data["empresa"] ?>
                </div>
                <div class="card-body p-2">
                    <div class="card-block">
                        <div id="infos">

                        </div>
                        <button type="button" class="shortcut primary">
                            <span class="badge">F1</span>
                            <span class="caption">Importar</span>
                            <span class="mif-search icon"></span>
                        </button>
                        <button type="button" id="botaoQuantidade" class="shortcut primary">
                            <span class="badge">F2</span>
                            <span class="caption">Nova Venda</span>
                            <span class="mif-add icon"></span>
                        </button>
                        <button type="button" id="botaoFinalizar" class="shortcut primary">
                            <span class="badge">F3</span>
                            <span class="caption">Finalizar</span>
                            <span class="mif-clipboard icon"></span>
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

<?= $this->start("scripts"); ?>
    <script>

        $(function() {
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
        });

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
                        "<span class='valorTotal'>Valor Total: <span id='valorTotal'>R$ " + valorTotal + "</span></span>");
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
            }
        }

        $(document).ready(function () {
            $("#codigoBarrasCaixa").focus();
        });

        $('#codigoBarras').on('keydown', null, 'f1', function () {
            $("#importarOrcamento").dialog('open');
            return false;
        });

        $(document).on('keydown', null, 'f1', function () {
            $("#importarOrcamento").dialog('open');
            return false;
        });

    </script>
<?= $this->end("scripts"); ?>