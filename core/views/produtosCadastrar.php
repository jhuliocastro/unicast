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
                        <h5>Cadastrar Produtos :: <?= $this->data["empresa"] ?></h5>
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
                                        <form method="post" action="/produtos/cadastrar">
                                            <div class="row">
                                                <div class="col-md-12" style="margin-top: 15px;">
                                                    <div class="form-group">
                                                        <label>Nome</label>
                                                        <input type="text" class="form-control" required name="nome" id="nome">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Descrição</label>
                                                        <textarea data-role="textarea" class="form-control" name="descricao" id="descricao"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Preço Venda</label>
                                                        <input type="text" class="form-control" required data-prepend="R$" placeholder="00,00" name="precoVenda" id="precoVenda">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Preço Compra</label>
                                                        <input type="text" class="form-control" required data-prepend="R$" placeholder="00,00" name="precoCompra" id="precoCompra">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Unidade de Medida</label>
                                                        <select id="unidadeMedida" name="unidadeMedida" class="form-control" data-filter="false">
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
                                                        <input type="number" class="form-control" value="1" required name="estoqueMinimo" id="estoqueMinimo">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Estoque Atual</label>
                                                        <input type="number" class="form-control" required value="0" name="estoqueAtual" id="estoqueAtual">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button type="submit" class="btn btn-primary">CADASTRAR</button>
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
        $("#precoVenda").mask("00,00");
        $("#precoCompra").mask("00,00");
    });
</script>
<?= $this->end("scripts"); ?>
