<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content container-fluid">
    <div class="card">
        <div class="card-header">
            Orçamento :: <?= $this->data["empresa"] ?>
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoOrcamento">Novo Orçamento</button>
                    <hr>
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

<div class="modal fade" id="modalNovoOrcamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formNovoOrcamento" method="post" action="/orcamento/novo">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Orçamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <div class="col-12">
                            <label>Selecione o Cliente</label>
                            <input type="text" list="clientes" id="cliente" name="cliente" class="form-control" required>
                            <datalist id="clientes"><?= $this->data["clientes"] ?></datalist>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-primary">Iniciar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->start("scripts"); ?>
<script>
    $(document).ready(function () {
        $('#tabela').DataTable({
            "paging": true,
            "aaSorting": [[0, "desc"]],
            'ajax': '/orcamento/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        })
    });

    function exportarPDF(id){
        window.open('/pdv/orcamento/pdf/' + id, '_blanck');
    }
</script>
<?= $this->end("scripts"); ?>
