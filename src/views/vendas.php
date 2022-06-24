<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content container-fluid">
    <div class="card">
        <div class="card-header">
            Vendas
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <table id="tabela" class="display compact" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Cliente</td>
                                <td>Orçamento</td>
                                <td>Valor Total</td>
                                <td>Valor Pago</td>
                                <td>Desconto</td>
                                <td>Troco</td>
                                <td>Dinheiro</td>
                                <td>Crédito</td>
                                <td>Débito</td>
                                <td>Crediário</td>
                                <td>Pix</td>
                                <td>Data/Hora</td>
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

<div id="janelaEstorno" title="Estornar Venda">
        <form>
            <fieldset>
                <div class="form-group">
                    <label>Informe o Motivo</label>
                    <textarea data-role="textarea" id="motivoEstorno" name="motivoEstorno"></textarea>
                </div>
                <hr>
                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>

<?= $this->start("scripts"); ?>
<script>
    var idVendaEstorno = null;
    var tabela;
    $(document).ready(function () {
        tabela = $('#tabela').DataTable({
            "paging": true,
            "order": [[0, "desc"]],
            'autoFill': true,
            'ajax': '/vendas/relacao',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });
    });

    function cupom(id){
        let caminho = '/pdv/imprimir/cupom/' + id;
        window.open(caminho, "janela2","width=600,height=700, directories=no, location=no, menubar=no, scrollbars=no, status=no, toolbar=no, resizable=no");
    }

    var dialog = $("#janelaEstorno").dialog({
        autoOpen: false,
        width: 800,
        buttons: {
            "Estornar": estornoSender
        }
    });

    var form = dialog.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        estornoSender();
    });

    function estorno(venda){
        idVendaEstorno = venda;
        $("#ui-id-1").html('Estornar Venda :: ' + venda);
        dialog.dialog('open');
    }

    function estornoSender(){
        $.ajax({
                url: "/pdv/vendas/estornar",
                type: 'post',
                dataType: 'JSON',
                data: {
                    idVenda: idVendaEstorno
                }
            })
                .done(function (retorno) {
                    console.log(retorno);
                    dialog.dialog('close');
                    if(retorno.status === true){
                        tabela.ajax.reload();
                        Swal.fire({
                            title: 'Venda Estornada!',
                            icon: 'success'
                        });
                    }else{
                        Swal.fire({
                            title: 'Erro ao estornar venda!',
                            text: retorno.error,
                            icon: 'error'
                        });
                    }
                })
                .fail(function (jqXHR, textStatus, msg) {
                    console.log(msg);

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
        window.location.href = "/produtos/cadastrar";
    }
    //FIM BOTAO CADASTRAR PRODUTO
</script>
<?= $this->end("scripts"); ?>
