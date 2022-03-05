<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>
<div class="pcoded-content">

    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-pie-chart bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Entrada de Estoque :: <?= $this->data["empresa"] ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card latest-update-card">
                                <div class="card-block">
                                    <div class="container">
                                        <form method="post" action="/estoque/entrada">
                                            <div class="row">
                                                <div class="col-md-12" style="margin-top: 15px;">
                                                    <div class="form-group">
                                                        <label>Produto</label>
                                                        <input class="form-control" type="search" required name="produto" id="produto" list="listaProdutos">
                                                        <datalist id="listaProdutos"><?= $this->data["produtos"] ?></datalist>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Quantidade</label>
                                                        <input type="number" class="form-control" value="1" required name="quantidade" id="quantidade">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button type="submit" class="btn btn-primary">INCLUIR</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->start("scripts"); ?>
<script>
    $(document).ready(function(){
        $("#precoVenda").mask('#.##0,00', {reverse: true});
        $("#precoCompra").mask('#.##0,00', {reverse: true});
        $("#nome").focus();
    });
</script>
<?= $this->end("scripts"); ?>
