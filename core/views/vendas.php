<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content">
    <div class="card">
        <div class="card-header">
            Vendas :: <?= $this->data["empresa"] ?>
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <div>

                        <hr>
                    </div>
                    <table id="tabela" class="display compact" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Cliente</td>
                                <td>Orçamento</td>
                                <td>Valor Total</td>
                                <td>Valor Pago</td>
                                <td>Forma Pagamento</td>
                                <td>Data/Hora</td>
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
            'ajax': '/pdv/vendas/relacao',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });
    });

    function cupom(orcamento, venda){
        window.open("/pdv/imprimir/cupom/" + orcamento + "/" + venda, '_blanck');
    }

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
