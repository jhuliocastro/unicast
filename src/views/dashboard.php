<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content">
    <div class="card">
        <div class="card-header">
            Dashboard :: <?= $this->data["empresa"] ?>
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <div class="col-md-3">
                        <div class="icon-box border bd-default">
                            <div class="icon bg-cyan fg-white"><span class="mif-widgets"></span></div>
                            <div class="content p-4">
                                <div class="text-upper">Produtos Cadastrados</div>
                                <div class="text-upper text-bold text-lead"><?= $this->data["totalProdutos"] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>