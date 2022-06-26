<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<style>
    .infos{
        text-align: right;
    }
</style>

<div class="pcoded-content container-fluid">
    <div class="card">
        <div class="card-header">
            Produtos
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <div>
                        <button id="cadastrar">Cadastrar Produto</button>
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
    <div>
        <form>
            <fieldset>
                <div class="row mb-3">
                    <label for="nomeCadastrar" class="col-sm-3 col-form-label">Nome Produto</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="nomeCadastrar" name="nomeCadastrar">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="unidadeMedidaCadastrar" class="col-sm-3 col-form-label">Unidade Medida</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="unidadeMedidaCadastrar" id="unidadeMedidaCadastrar">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="valorCompraCadastrar" class="col-sm-3 col-form-label">Valor Compra</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">R$</span>
                            <input type="text" class="form-control form-control-sm" name="valorCompraCadastrar" id="valorCompraCadastrar">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="valorVendaCadastrar" class="col-sm-3 col-form-label">Valor Venda</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">R$</span>
                            <input type="text" class="form-control form-control-sm" name="valorVendaCadastrar" id="valorVendaCadastrar">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="estoqueCadastrar" class="col-sm-3 col-form-label">Estoque</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="estoqueCadastrar" id="estoqueCadastrar">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="codigoBarrasCadastrar" class="col-sm-3 col-form-label">Código Barras</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="codigoBarrasCadastrar" id="codigoBarrasCadastrar">
                    </div>
                </div>
                <hr>
                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>

</div>

<div id="janelaAlterarValor" title="Alterar Valor">
    <form>
        <fieldset>
            <div class="row">
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" class="form-control form-control-sm" disabled name="produtoAlterarValor" id="produtoAlterarValor">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="valorCompraAlterarValor" class="col-sm-3 col-form-label">Valor Compra</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">R$</span>
                        <input type="text" class="form-control form-control-sm" name="valorCompraAlterarValor" id="valorCompraAlterarValor">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="valorVendaAlterarValor" class="col-sm-3 col-form-label">Valor Venda</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">R$</span>
                        <input type="text" class="form-control form-control-sm" name="valorVendaAlterarValor" id="valorVendaAlterarValor">
                    </div>
                </div>
            </div>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>

<div id="janelaEntradaEstoque" title="Entrada Estoque">
    <form>
        <fieldset>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="text" class="form-control form-control-sm" disabled name="produtoEntradaEstoque" id="produtoEntradaEstoque">
                </div>
            </div>
            <div class="row">
                <div class="form-floating">
                    <input type="number" class="form-control form-control-sm" id="quantidadeEntrada" name="quantidadeEntrada">
                    <label for="quantidadeEntrada">Informe a Quantidade</label>
                </div>
            </div>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>

<div id="janelaSaidaEstoque" title="Saída Estoque">
    <form>
        <fieldset>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="text" class="form-control form-control-sm" disabled name="produtoSaidaEstoque" id="produtoSaidaEstoque">
                </div>
            </div>
            <div class="row">
                <div class="form-floating">
                    <input type="number" class="form-control form-control-sm" id="quantidadeSaida" name="quantidadeSaida">
                    <label for="quantidadeEntrada">Informe a Quantidade</label>
                </div>
            </div>
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
            'iDisplayLength': 50,
            'ajax': '/produtos/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $("#valorVendaAlterarValor").mask('#.##0,00', {reverse: true});
        $("#valorVendaCadastrar").mask('#.##0,00', {reverse: true});
        $("#valorCompraAlterarValor").mask('#.##0,00', {reverse: true});
        $("#valorCompraCadastrar").mask('#.##0,00', {reverse: true});

        $("#cadastrar").button();
        $("#cadastrar").click(function(){
            dialogCadastrar.dialog('open');
        });
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

    var dialog = $("#janelaAlterarValor").dialog({
        autoOpen: false,
        modal: true,
        width: 600
    });

    var dialogCadastrar = $("#janelaCadastrarProduto").dialog({
        autoOpen: false,
        modal: true,
        width: 600,
        buttons: {
            "Cadastrar": cadastrarSender
        }
    });

    var dialogEntradaEstoque = $("#janelaEntradaEstoque").dialog({
        autoOpen: false,
        modal: true,
        width: 600
    });

    var dialogSaidaEstoque = $("#janelaSaidaEstoque").dialog({
        autoOpen: false,
        modal: true,
        width: 600
    });

    function cadastrarSender(){
       let nome = $("#nomeCadastrar").val();
       let codigoBarras = $("#codigoBarrasCadastrar").val();
       let precoVenda = $("#valorVendaCadastrar").val();
       let precoCompra = $("#valorCompraCadastrar").val();
       let unidadeMedida = $("#unidadeMedidaCadastrar").val();
       let estoque = $("#estoqueCadastrar").val();

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
                   unidadeMedida: unidadeMedida,
                   estoque: estoque
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

    function excluir(id){
        Swal.fire({
            icon: 'question',
            title: 'Confirma Exclusão do Produto?',
            text: 'ID: ' + id,
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            type: 'POST',
            url: '/produtos/excluir',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(retorno) {
                console.log(retorno);
                if(retorno.status === true){
                    tabela.ajax.reload();
                    Swal.fire('Produto Excluído!', '', 'success'); 
                }else{ 
                    Swal.fire('Operação não realizada!', retorno.erro, 'error'); 
                }
            }
        });
        }else{
            Swal.fire('Operação cancelada pelo usuário!!', '', 'info');
        }
        });
    }
</script>
<?= $this->end("scripts"); ?>
