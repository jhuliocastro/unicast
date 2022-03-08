<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content">
    <div class="card">
        <form method="post" action="/produtos/cadastrar">
            <div class="card-header">
                Cadastrar Produtos :: <?= $this->data["empresa"] ?>
            </div>
            <div class="card-body p-2">
                <div class="card-block">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12" style="margin-top: 15px;">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text"
                                           autocomplete="off"
                                           data-role="input"
                                           required
                                           name="nome"
                                           id="nome">
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
                                              id="descricao"></textarea>
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
                                           placeholder="00,00"
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
                                           id="precoCompra">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Unidade de Medida</label>
                                    <select id="unidadeMedida" name="unidadeMedida" data-role="select"
                                            data-filter="false">
                                        <option>UN</option>
                                        <option>CX</option>
                                        <option>RL</option>
                                        <option>PT</option>
                                        <option>M2</option>
                                        <option>M</option>
                                        <option>CM</option>
                                        <option>KG</option>
                                        <option>L</option>
                                        <option>G</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Estoque Mínimo</label>
                                    <input type="number" data-role="spinner" value="1" required name="estoqueMinimo"
                                           id="estoqueMinimo">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Estoque Atual</label>
                                    <input type="number" data-role="spinner" required value="0" name="estoqueAtual"
                                           id="estoqueAtual">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button>CADASTRAR PRODUTO</button>
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
