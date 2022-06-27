<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>
<div class="pcoded-content container-fluid">
    <div class="card">
        <div class="card-header">
            Caixa Diario
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <div>
                        <button id="sangria">Realizar Sangria</button>
                        <button id="fecharCaixa">Fechar Caixa</button>
                        <hr>
                    </div>
                    <table id="tabela" class="display compact" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Descrição</td>
                                <td>Tipo</td>
                                <td>Valor</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="janelaSangria" title="Sangria">
    <form>
        <fieldset>
            <div class="row mb-3">
                <div class="col-md-3 infos">
                    <label>Descrição: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" required class="form-control form-control-sm" name="descricaoSangria" id="descricaoSangria">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 infos">
                    <label>Valor: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control form-control-sm" id="valorSangria" name="valorSangria">
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

    function excluir(id){
        Swal.fire({
            title: 'Confirma exclusão do caixa?',
            text: "Essa ação não tem volta!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Voltar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '/caixaDiario/excluir',
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(retorno) {
                        console.log(retorno);
                        tabela.ajax.reload();
                        if(retorno.status == true){
                            Swal.fire(
                                'Excluído!',
                                '',
                                'success'
                            );
                        }else{
                            Swal.fire(
                                'Erro ao excluir!',
                                retorno.erro,
                                'error'
                            );
                        }
                    }
                });

                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }

    function imprimirSaida(id){
        window.open("/caixaDiario/cupom/sangria/" + id, "janela2","width=850,height=700, directories=no, location=no, menubar=no, scrollbars=no, status=no, toolbar=no, resizable=no");
    }

    function sangria(){
        let descricao = $("#descricaoSangria").val();
        let valor = $("#valorSangria").val();
        if(descricao === "" || valor === ""){
            alert('Campos em branco!');
        }else{
            $.ajax({
                type: 'POST',
                url: '/caixaDiario/sangria',
                dataType: "JSON",
                data: {
                    descricao: descricao,
                    valor: valor
                },
                success: function(retorno) {
                    dialog.dialog('close');
                    tabela.ajax.reload();
                    if(retorno.status == true){
                        Swal.fire(
                            'Sangria Efetuada!',
                            '',
                            'success'
                        );
                    }else{
                        Swal.fire(
                            'Erro ao realizar sangria!',
                             retorno.erro,
                            'error'
                        );
                    }
                }
            });
        }
    }

    var dialog = $("#janelaSangria").dialog({
        autoOpen: false,
        width: 600,
        buttons: {
            "Realizar Sangria": sangria
        }
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

    $(document).ready(function(){
        $("#sangria").button();
        $("#fecharCaixa").button();

        $("#valorSangria").mask('#.##0,00', {reverse: true});

        tabela = $('#tabela').DataTable({
            "paging": false,
            'ajax': '/caixaDiario/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $("#fecharCaixa").click(function(){
            window.location.href = "/caixaDiario/fechar";
        });

        $("#sangria").click(function (){
           dialog.dialog('open');
        });



    });
</script>

<?= $this->end("scripts"); ?>
