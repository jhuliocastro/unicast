<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content">
    <div class="card">
        <form method="post" action="/pdv/orcamento/andamento">
            <div class="card-header">
                Novo Orçamento :: <?= $this->data["empresa"] ?>
            </div>
            <div class="card-body p-2">
                <div class="card-block">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12" style="margin-top: 15px;">
                                <div class="form-group">
                                    <label>Cliente</label>
                                    <select id="cliente"
                                            name="cliente"
                                            data-role="select"
                                    ><?= $this->data["clientes"] ?>"</select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button>Iniciar Orçamento</button>
            </div>
        </form>
    </div>
</div>

<?= $this->start("scripts"); ?>
<script>
    $(document).ready(function () {
        $("#precoVenda").mask('#.##0,00', {reverse: true});
        $("#precoCompra").mask('#.##0,00', {reverse: true});
        $("#nome").focus();
    });
</script>
<?= $this->end("scripts"); ?>
