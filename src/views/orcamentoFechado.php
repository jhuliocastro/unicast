<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<style>
    .valorTotal{
        float: right;
        color: darkgreen;
        font-size: 26px;
        font-weight: bold;
    }
</style>

<div class="pcoded-content">
    <div class="card">
        <form method="post" action="/pdv/orcamento/andamento" id="formEstoque">
            <div class="card-header">
                Vizualização de Orçamento :: <?= $this->data["empresa"] ?> :: <?= $this->data["cliente"] ?>
            </div>
            <div class="card-body p-2">
                <div class="card-block">
                    <span class="valorTotal">Valor Total: <span id="valorTotal"></span></span>

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

<?= $this->start("scripts"); ?>
<script>
    var quantidade = 1;

    <?php
    if($this->data["valorTotalJS"] == null){
        echo "var valorTotalOrcamento = 0;";
    }else{
        echo "valorTotalOrcamento = ".$this->data["valorTotalJS"].";";
    }
    ?>

    valorTotalOrcamento = (Math.round(valorTotalOrcamento * 100) / 100).toFixed(2);
    $("#valorTotal").html("R$ "+valorTotalOrcamento);

    $(document).ready(function () {
        $('#tabela').DataTable({
            "paging": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });
    });
</script>
<?= $this->end("scripts"); ?>
