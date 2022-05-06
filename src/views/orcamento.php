<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content">
    <div class="card">
        <div class="card-header">
            Orçamento :: <?= $this->data["empresa"] ?>
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <button type="button" class="shortcut primary" id="botaoNovoOrcamento">
                        <span class="badge">F1</span>
                        <span class="caption">Novo</span>
                        <span class="mif-add icon"></span>
                    </button>
                    <table id="tabela" class="display compact" style="width: 100%;">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Cliente</td>
                            <td>Valor</td>
                            <td>Situação</td>
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
    $(document).ready(function () {
        $("#botaoNovoOrcamento").click(function(){
            window.location.href = "/pdv/orcamento/novo";
        });

        $('#tabela').DataTable({
            "paging": true,
            "aaSorting": [[0, "desc"]],
            'ajax': '/pdv/orcamento/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $(document).on('keydown', null, 'f1', function () {
            window.location.href = "/pdv/orcamento/novo";
            return false;
        });         
        
    });

    function exportarPDF(id){
        window.open('/pdv/orcamento/pdf/' + id, '_blanck');
    }
</script>
<?= $this->end("scripts"); ?>
