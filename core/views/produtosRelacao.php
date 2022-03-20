<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content">
    <div class="card">
        <div class="card-header">
            Produtos :: <?= $this->data["empresa"] ?>
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid tabela">
                    <div>

                    </div>
                    <table id="tabela" class="display compact">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Produto</td>
                                <td>Preço Custo</td>
                                <td>Preço Venda</td>
                                <td>Estoque Mínimo</td>
                                <td>Estoque Atual</td>
                                <td>Tipo</td>
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
        $('#tabela').DataTable({
            "paging": false,
            'ajax': '/produtos/tabela',
        });
    });
</script>
<?= $this->end("scripts"); ?>
