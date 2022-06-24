
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
                    <button id='importarXML'>Importar XML</button>
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

<div id="janelaXML" title="Importar XML">
    <form method="post" id="formXML" action="/nfe/importar/xml" enctype="multipart/form-data">
        <fieldset>
                <div class="mb-3">
                    <label for="xml" class="form-label">Selecione o XML</label>
                    <input class="form-control" type="file" id="xml" name="xml" accept=".xml">
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

        $("#importarXML").button();
        $("#importarXML").click(function(){
            dialog.dialog('open');
        });
    });

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
<?= $this->end("scripts"); ?>
