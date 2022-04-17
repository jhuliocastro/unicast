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
            Empresas :: <?= $this->data["empresa"] ?>
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
                                <td>CNPJ</td>
                                <td>Razao Social</td>
                                <td>Nome Fantasia</td>
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

<div id="janelaCadastrar" title="Cadastrar Empresa">
    <form>
        <fieldset>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Razão Social*: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" id="razaoSocialCadastrar">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Nome Fantasia*: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" id="nomeFantasiaCadastrar">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>CNPJ: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" id="cnpjCadastrar">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Endereço: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" id="enderecoCadastrar">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Número: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" id="numeroCadastrar">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>Bairro: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" id="bairroCadastrar">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 infos">
                    <label>CEP: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" data-role="input" class="input-small" id="cepCadastrar">
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
            "order": [[2, "asc"]],
            'ajax': '/empresas/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });


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
        dialog.dialog('open');
    }
    //FIM BOTAO CADASTRAR PRODUTO

    var dialog = $("#janelaCadastrar").dialog({
        autoOpen: false,
        width: 600,
        buttons: {
            "Cadastrar": cadastrarSender
        }
    });

    function cadastrarSender(){
       let razaoSocial = $("#razaoSocialCadastrar").val();
       let nomeFantasia = $("#nomeFantasiaCadastrar").val();
       let razaoSocial = $("#razaoSocialCadastrar").val();
       let razaoSocial = $("#razaoSocialCadastrar").val();
       let razaoSocial = $("#razaoSocialCadastrar").val();
       let razaoSocial = $("#razaoSocialCadastrar").val();

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

</script>
<?= $this->end("scripts"); ?>
