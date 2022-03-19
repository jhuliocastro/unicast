<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content">
    <div class="card">
        <form method="post" action="/produtos/editar">
            <div class="card-header">
                <input type="hidden" id="id" name="id" value="<?= $this->data["id"] ?>">
                Editar Produto :: <?= $this->data["nomeProduto"] ?> :: <?= $this->data["empresa"] ?>
            </div>
            <div class="card-body p-2">
                <div class="card-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8" style="margin-top: 15px;">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text"
                                           autocomplete="off"
                                           data-role="input"
                                           required
                                           name="nome"
                                           id="nome"
                                            value="<?= $this->data["nomeProduto"] ?>">
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 15px;">
                                <div class="form-group">
                                    <label>Código de Barras</label>
                                    <input type="number" id="codigoBarras" name="codigoBarras" value="<?= $this->data["codigoBarras"] ?>" data-role="input">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <textarea data-role="textarea"
                                              autocomplete="off"
                                              class="form-control"
                                              name="descricao"
                                              id="descricao"
                                              value="<?= $this->data["descricao"] ?>"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Preço Venda</label>
                                    <input type="text"
                                           data-role="input"
                                           data-prepend="R$"
                                           id="precoVenda"
                                           name="precoVenda"
                                           autocomplete="off"
                                           required
                                           value="<?= $this->data["precoVenda"] ?>"
                                    >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Preço Compra</label>
                                    <input type="text"
                                           autocomplete="off"
                                           required
                                           data-role="input"
                                           data-prepend="R$"
                                           placeholder="00,00"
                                           name="precoCompra"
                                           id="precoCompra"
                                           value="<?= $this->data["precoCompra"] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Unidade de Medida</label>
                                    <input type="text" data-role="input" value="<?= $this->data["unidadeMedida"] ?>" id="unidadeMedida" name="unidadeMedida">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Estoque Mínimo</label>
                                    <input type="number" data-role="spinner" required name="estoqueMinimo"
                                           id="estoqueMinimo" value="<?= $this->data["quantidadeMinima"] ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Estoque Atual</label>
                                    <input type="number" data-role="spinner" required name="estoqueAtual"
                                           id="estoqueAtual" value="<?= $this->data["quantidadeAtual"] ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button>SALVAR ALTERAÇÕES</button>
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
