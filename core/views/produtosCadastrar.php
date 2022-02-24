<?php
$this->layout("_theme", $this->data);
?>
<div class="row border-bottom bd-lightGray m-3">
    <div class="cell-md-4 d-flex flex-align-center">
        <h3 class="dashboard-section-title text-center text-left-md w-100">Cadastrar Produtos</h3>
    </div>
</div>
<div class="row">
    <div class="cell-md-12">
        <form method="post" action="/produtos/cadastrar">
            <div class="card">
                <div class="card-content p-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" data-role="input" required name="nome" id="nome">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea data-role="textarea" name="descricao" id="descricao"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Preço Venda</label>
                                <input type="text" data-role="input" required data-prepend="R$" placeholder="00,00" name="precoVenda" id="precoVenda">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Preço Compra</label>
                                <input type="text" data-role="input" required data-prepend="R$" placeholder="00,00" name="precoCompra" id="precoCompra">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Unidade de Medida</label>
                                <select id="unidadeMedida" name="unidadeMedida" data-role="select" data-filter="false">
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
                                <input type="number" data-role="input" value="1" required name="estoqueMinimo" id="estoqueMinimo">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Estoque Atual</label>
                                <input type="number" data-role="input" required value="0" name="estoqueAtual" id="estoqueAtual">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="button primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->start("scripts"); ?>
<script>
    $(document).ready(function(){
        $("#precoVenda").mask("00,00");
        $("#precoCompra").mask("00,00");
    });
</script>
<?= $this->end("scripts"); ?>
