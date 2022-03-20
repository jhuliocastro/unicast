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
                <div class="container-fluid">
                    <div>
                        <button class="image-button" id="cadastrar">
                            <span class="caption">F1 - Cadastrar</span>
                            <span class="icon"><img src="/assets/images/cadastrar.png"></span>
                        </button>
                        <hr>
                    </div>
                    <table id="tabela" class="display compact" style="width: 100%;">
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

    //INICIO BOTAO CADASTRAR PRODUTO
    $(document).on('keydown', null, 'f1', function () {
        cadastrar();
        return false;
    });

    $("#cadastrar").click(function(){
       cadastrar();
    });

    function cadastrar(){
        window.location.href = "/produtos/cadastrar";
    }
    //FIM BOTAO CADASTRAR PRODUTO
</script>
<?= $this->end("scripts"); ?>
