
<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content container-fluid">
    <div class="card">
        <div class="card-header">
            NFe
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalImportar">Importar XML</button>
                    <hr>
                    <table id="tabela" class="display compact" style="width: 100%;">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nº NFe</td>
                            <td>Empresa</td>
                            <td>Fornecedor</td>
                            <td>Valor</td>
                            <td>Data Emissão</td>
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

<div class="modal fade" id="modalImportar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" id="formXML" action="/nfe/importar/xml" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Importar XML</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="xml" class="form-label">Selecione o XML</label>
                        <input class="form-control" type="file" id="xml" name="xml" accept=".xml">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-primary">Importar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->start("scripts") ?>
<script>
    var tabela;
    $(document).ready(function () {
        tabela = $('#tabela').DataTable({
            "paging": true,
            "order": [[0, "desc"]],
            'autoFill': true,
            'responsive': true,
            'ajax': '/nfe/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });
    });

    function danfe(caminho){
    window.open(caminho, "janela2","width=850,height=700, directories=no, location=no, menubar=no, scrollbars=no, status=no, toolbar=no, resizable=no");
}

function excluir(chave){
    Swal.fire({
        icon: 'question',
        title: 'Confirma Exclusão da Nota?',
        text: 'CHAVE: ' + chave,
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/nfe/excluir',
                dataType: "JSON",
                data: {
                    chave: chave
                },
                success: function(retorno) {
                    console.log(retorno);
                    if(retorno.status === true){
                        tabela.ajax.reload();
                        Swal.fire('Nota Excluída!', '', 'success');
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

    var dialog = $("#janelaXML").dialog({
        autoOpen: false,
        width: 800,
        modal: true,
        show: {
            effect: "fade",
            duration: 200
        },
        hide: {
            effect: "fade",
            duration: 200
        },
        buttons: {
            "Importar": importarSender
        }
    });

    function importarSender(){
        $("#formXML").submit();
    }

</script>
<?= $this->end("scripts") ?>
