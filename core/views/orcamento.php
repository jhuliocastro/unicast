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
                    <button class="shortcut" id="botaoNovoOrcamento" style="margin-bottom: 10px; background-color: white;">
                        <img style="width: 100%;" src="/assets/images/cadastrar.png">
                    </button>
                    <table class="table" data-role="table" data-source="/pdv/orcamento/tabela"></table>
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
    });
</script>
<?= $this->end("scripts"); ?>
