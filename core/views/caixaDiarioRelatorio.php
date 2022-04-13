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
            RELÁTORIO DE CAIXA DIÁRIO :: <?= $this->data["empresa"] ?>
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
                                <td>Data</td>
                                <td>Valor</td>
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

<?= $this->start("scripts"); ?>
<script>   
    var tabela;

    $(document).ready(function () {
        tabela = $('#tabela').DataTable({
            "paging": true,
            "order": [[0, "desc"]],
            'ajax': '/relatorios/caixaDiario/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });
    });

    function relatorio(id){
        window.open("/relatorios/caixaDiario/imprimir/" + id, '_blanck');
    }
</script>
<?= $this->end("scripts"); ?>
