<?php
$this->data["empresa"] = EMPRESA;
?>
<div class="pcoded-content">
    <div class="card">
        <form method="post" action="/pdv/orcamento/andamento" id="formEstoque">
            <div class="card-header">
                Orçamento :: <?= $this->data["empresa"] ?> :: <?= $this->data["cliente"] ?>
            </div>
            <div class="card-body p-2">
                <div class="card-block">
                    <span class="valorTotal">Valor Total: <span id="valorTotal">R$ <?= $this->data["valorTotal"] ?></span></span>

                </div>
            </div>
            <hr>
            <table id="tabela" class="display compact" style="width: 100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>PRODUTO</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR UNT</th>
                    <th>VALOR TOTAL</th>
                </tr>
                </thead>
                <tbody>
                <?= $this->data["tabela"] ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#tabela').DataTable({
            "paging": false,
            "aaSorting": [[0, "desc"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });
    });
</script>
