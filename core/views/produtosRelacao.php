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
                                <td>Produto</td>
                                <td>Preço Venda</td>
                                <td>Preço Custo</td>
                                <td>Estoque Mínimo</td>
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

<?= $this->start("scripts"); ?>
<script>   
    var tabela;

    $(document).ready(function () {
        var produtoAlterarValor = null;

        tabela = $('#tabela').DataTable({
            "paging": false,
            "order": [[1, "asc"]],
            'ajax': '/produtos/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $("#valorVendaAlterarValor").mask('#.##0,00', {reverse: true});
        $("#valorCompraAlterarValor").mask('#.##0,00', {reverse: true});
    });

    //INICIO BOTAO CADASTRAR PRODUTO
    $(document).on('keydown', null, 'f1', function () {
        cadastrar();
        return false;
    });

    $("#cadastrar").click(function(){
       cadastrar();
    });

    function cadastrar(){
        window.location.href = "/produtos/cadastrar";
    }
    //FIM BOTAO CADASTRAR PRODUTO

    var dialog = $("#janelaAlterarValor").dialog({
        autoOpen: false,
        width: 600
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
