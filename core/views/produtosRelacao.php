<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<style>
    .infos{
        text-align: right;
    }
</style>

<div class="pcoded-content">
    <div class="card">
        <div class="card-header">
            Produtos :: <?= $this->data["empresa"] ?>
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <div>
                        <button id="cadastrar">F1 - CADASTRAR</button>
                        <hr>
                    </div>
                    <table id="tabela" class="display compact" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Código Barras</td>
                                <td>Produto</td>
                                <td>Preço Venda</td>
                                <td>Estoque Atual</td>
                                <td>Tipo</td>
                                <td>Ações</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="janelaCadastrarProduto" title="Cadastrar Produto">
    <form>
        <fieldset>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Nome*: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" name="nomeCadastrar" id="nomeCadastrar">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Unidade Medida*: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" name="unidadeMedidaCadastrar" id="unidadeMedidaCadastrar">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Valor Compra: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-prepend="R$" data-role="input" class="input-small" id="valorCompraCadastrar" name="valorCompraCadastrar">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Valor Venda: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-prepend="R$" data-role="input" class="input-small" id="valorVendaCadastrar" name="valorVendaCadastrar">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Código de Barras*: </label>
                </div>
                <div class="col-md-8">
                    <input type="number" data-role="input" class="input-small" name="codigoBarrasCadastrar" id="codigoBarrasCadastrar">
                </div>
            </div>
            <hr>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>

<div id="janelaAlterarValor" title="Alterar Valor">
    <form>
        <fieldset>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Produto: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" disabled name="produtoAlterarValor" id="produtoAlterarValor">
                </div>  
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Valor Compra: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-prepend="R$" data-role="input" class="input-small" id="valorCompraAlterarValor" name="valorCompraAlterarValor">
                </div>  
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Valor Venda: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-prepend="R$" data-role="input" class="input-small" id="valorVendaAlterarValor" name="valorVendaAlterarValor">
                </div>  
            </div>
            <hr>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>

<div id="janelaEntradaEstoque" title="Entrada Estoque">
    <form>
        <fieldset>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Produto: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" disabled name="produtoEntradaEstoque" id="produtoEntradaEstoque">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Quantidade: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-prepend="R$" data-role="input" class="input-small" id="quantidadeEntrada" name="quantidadeEntrada">
                </div>
            </div>
            <hr>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>

<div id="janelaSaidaEstoque" title="Saída Estoque">
    <form>
        <fieldset>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Produto: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" disabled name="produtoSaidaEstoque" id="produtoSaidaEstoque">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Quantidade: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-prepend="R$" data-role="input" class="input-small" id="quantidadeSaida" name="quantidadeSaida">
                </div>
            </div>
            <hr>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>

<?= $this->start("scripts"); ?>
<script>   
    var tabela;

    $(document).ready(function () {
        var produtoAlterarValor = null;

        tabela = $('#tabela').DataTable({
            "paging": true,
            "order": [[2, "asc"]],
            'ajax': '/produtos/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $("#valorVendaAlterarValor").mask('#.##0,00', {reverse: true});
        $("#valorVendaCadastrar").mask('#.##0,00', {reverse: true});
        $("#valorCompraAlterarValor").mask('#.##0,00', {reverse: true});
        $("#valorCompraCadastrar").mask('#.##0,00', {reverse: true});
    });

    function saidaEstoque(id) {
        $.ajax({
            type: 'POST',
            url: '/produtos/pesquisar/dados/id',
            dataType: "JSON",
            data: {
                id: id,
            },
            success: function(retorno) {
                console.log(retorno);
                $("#produtoSaidaEstoque").val(retorno.produto);
                dialogSaidaEstoque.dialog('open');
                $("#quantidadeSaida").focus();
            }
        });
    }

    function entradaEstoque(id) {
        $.ajax({
            type: 'POST',
            url: '/produtos/pesquisar/dados/id',
            dataType: "JSON",
            data: {
                id: id,
            },
            success: function(retorno) {
                console.log(retorno);
                $("#produtoEntradaEstoque").val(retorno.produto);
                dialogEntradaEstoque.dialog('open');
                $("#quantidadeEntrada").focus();
            }
        });

    }

    //INICIO BOTAO CADASTRAR PRODUTO
    $(document).on('keydown', null, 'f1', function () {
        cadastrar();
        return false;
    });

    $("#cadastrar").click(function(){
       cadastrar();
    });

    function cadastrar(){
        dialogCadastrar.dialog('open');
    }
    //FIM BOTAO CADASTRAR PRODUTO

    var dialog = $("#janelaAlterarValor").dialog({
        autoOpen: false,
        width: 600
    });

    var dialogCadastrar = $("#janelaCadastrarProduto").dialog({
        autoOpen: false,
        width: 600,
        buttons: {
            "Cadastrar": cadastrarSender
        }
    });

    var dialogEntradaEstoque = $("#janelaEntradaEstoque").dialog({
        autoOpen: false,
        width: 600
    });

    var dialogSaidaEstoque = $("#janelaSaidaEstoque").dialog({
        autoOpen: false,
        width: 600
    });

    function cadastrarSender(){
       let nome = $("#nomeCadastrar").val();
       let codigoBarras = $("#codigoBarrasCadastrar").val();
       let precoVenda = $("#valorVendaCadastrar").val();
       let precoCompra = $("#valorCompraCadastrar").val();
       let unidadeMedida = $("#unidadeMedidaCadastrar").val();

       if(nome === "" || codigoBarras === "" || unidadeMedida === ""){
           Swal.fire(
               'Campos Obrigatórios em Branco!',
               "Verifique os dados e tente novamente.",
               'error'
           );
       }else{
           $.ajax({
               type: 'POST',
               url: '/produtos/cadastrar',
               dataType: "JSON",
               data: {
                   nome: nome,
                   codigoBarras: codigoBarras,
                   precoVenda: precoVenda,
                   precoCompra: precoCompra,
                   unidadeMedida: unidadeMedida
               },
               success: function(retorno) {
                   console.log(retorno);
                   dialogCadastrar.dialog('close');
                   tabela.ajax.reload();
                   if(retorno.status === true){
                       Swal.fire(
                           'Produto Cadastrado!',
                           '',
                           'success'
                       );
                   }else{
                       if(retorno.erro === "existe"){
                           Swal.fire(
                               'Produto com o mesmo nome já exixte!',
                               "Verifique os dados e tente novamente.",
                               'error'
                           );
                       }else{
                           Swal.fire(
                               'Erro ao cadastrar produto!',
                               retorno.erro,
                               'error'
                           );
                       }

                   }

                   $("#nomeCadastrar").val("");
                   $("#codigoBarrasCadastrar").val("");
                   $("#valorVendaCadastrar").val("");
                   $("#valorCompraCadastrar").val("");
                   $("#unidadeMedidaCadastrar").val("");
               }
           });
       }
    }

    var form4 = dialogEntradaEstoque.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/estoque/entrada',
            dataType: "JSON",
            data: {
                produto: $("#produtoEntradaEstoque").val(),
                quantidadeEntrada: $("#quantidadeEntrada").val()
            },
            success: function(retorno) {
                console.log(retorno);

                $("#produtoEntradaEstoque").val("");
                $("#quantidadeEntrada").val("");
                dialogEntradaEstoque.dialog('close');

                if(retorno.status === true){
                    tabela.ajax.reload();
                    Swal.fire(
                        'Estoque Atualizado!',
                        '',
                        'success'
                    );
                }else{
                    Swal.fire(
                        'Erro ao atualizar estoque!',
                        retorno.erro,
                        'error'
                    );
                }
            }
        });
    });

    var form3 = dialogSaidaEstoque.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/estoque/saida',
            dataType: "JSON",
            data: {
                produto: $("#produtoSaidaEstoque").val(),
                quantidadeSaida: $("#quantidadeSaida").val()
            },
            success: function(retorno) {
                console.log(retorno);

                $("#produtoSaidaEstoque").val("");
                $("#quantidadeSaida").val("");
                dialogSaidaEstoque.dialog('close');

                if(retorno.status === true){
                    tabela.ajax.reload();
                    Swal.fire(
                        'Estoque Atualizado!',
                        '',
                        'success'
                    );
                }else{
                    Swal.fire(
                        'Erro ao atualizar estoque!',
                        retorno.erro,
                        'error'
                    );
                }
            }
        });
    });

    var form2 = dialogCadastrar.find( "form" ).on( "submit", function( event ) {
       event.preventDefault();
       cadastrarSender();
    });

    var form = dialog.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/produtos/alterar/valor',
            dataType: "JSON",
            data: {
                id: produtoAlterarValor,
                valorCompra: $("#valorCompraAlterarValor").val(),
                valorVenda: $("#valorVendaAlterarValor").val()
            },
            success: function(retorno) {
                dialog.dialog('close');
                tabela.ajax.reload();
                if(retorno.status == true){
                    Swal.fire(
                        'Valor Atualizado!',
                        '',
                        'success'
                    );
                }else{
                    Swal.fire(
                        'Erro ao atualizar valor!',
                        retorno.erro,
                        'error'
                    );
                }
            }
        });
    });

    function abrirJanelaAlterarValor(id){
        produtoAlterarValor = id;
        $.ajax({
            type: 'POST',
            url: '/produtos/pesquisar/dados/id',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(retorno) {
                $("#produtoAlterarValor").val(retorno.produto);
                $("#valorCompraAlterarValor").val(retorno.valorCompra);
                $("#valorVendaAlterarValor").val(retorno.valorVenda);
            }
        });

        $("#janelaAlterarValor").dialog('open');
    }
</script>
<?= $this->end("scripts"); ?>
