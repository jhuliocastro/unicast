<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content">
    <div class="card">
        <div class="card-header">
            Estoque :: <?= $this->data["empresa"] ?>
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <table id="tabela" class="display compact" style="width: 100%;">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>PRODUTO</td>
                            <td>ESTOQUE ATUAL</td>
                            <td>AÇÕES</td>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dialog" data-role="dialog" id="dialogSaidaEstoque">
    <form method="post" action="/estoque/saida">
        <div class="dialog-title">Saída Estoque</div>
        <div class="dialog-content">
            <input type="hidden" id="idQuantidadeSaida" name="idQuantidadeSaida">
            <input type="number" data-role="input" id="quantidadeSaida" name="quantidadeSaida">
        </div>
        <div class="dialog-actions">
            <button class="js-dialog-close" required>Confirmar</button>
            <button type="button" class="js-dialog-close">Voltar</button>
        </div>
    </form>
</div>

<div class="dialog" data-role="dialog" id="dialogEntradaEstoque">
    <form method="post" action="/estoque/entrada">
        <div class="dialog-title">Entrada Estoque</div>
        <div class="dialog-content">
            <input type="hidden" id="idQuantidadeEntrada" name="idQuantidadeEntrada">
            <input type="number" data-role="input" id="quantidadeEntrada" name="quantidadeEntrada">
        </div>
        <div class="dialog-actions">
            <button class="js-dialog-close" required>Confirmar</button>
            <button type="button" class="js-dialog-close">Voltar</button>
        </div>
    </form>
</div>

<?= $this->start("scripts"); ?>
<script>
    $(document).ready(function () {
        $('#tabela').DataTable({
            "paging": false,
            'ajax': '/estoque/lista',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });
    });

    function saidaEstoque(id) {
        $("#idQuantidadeSaida").val(id);
        Metro.dialog.open("#dialogSaidaEstoque");
        $("#quantidadeSaida").focus();
    }

    function entradaEstoque(id) {
        $("#idQuantidadeEntrada").val(id);
        Metro.dialog.open("#dialogEntradaEstoque");
        $("#quantidadeEntrada").focus();
    }
</script>
<?= $this->end("scripts"); ?>
