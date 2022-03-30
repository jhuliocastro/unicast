<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>
<div class="pcoded-content">
    <div class="card">
        <div class="card-header">
            Caixa Diario :: <?= $this->data["empresa"] ?>
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <div>
                        <button type="button" id="fecharCaixa" class="shortcut primary">
                            <span class="caption">Fechar</span>
                            <span class="mif-exit icon"></span>
                        </button>
                        <hr>
                    </div>
                    <table id="tabela" class="display compact" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Descrição</td>
                                <td>Valor</td>
                                <td>Tipo</td>
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
    $(document).ready(function(){
        var tabela = $('#tabela').DataTable({
            "paging": false,
            'ajax': '/caixaDiario/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $("#fecharCaixa").click(function(){
            window.location.href = "/caixaDiario/fechar";
        });
    });
</script>

<?= $this->end("scripts"); ?>
