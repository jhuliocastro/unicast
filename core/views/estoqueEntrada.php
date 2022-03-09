<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>
<div class="pcoded-content">

    <div class="pcoded-content">
        <div class="card">
            <div class="card-header">
                Entrada Estoque :: <?= $this->data["empresa"] ?>
            </div>
            <form method="post" action="/estoque/entrada">
                <div class="card-body p-2">
                    <div class="card-block">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 15px;">
                                    <div class="form-group">
                                        <label>Produto</label>
                                        <select data-role="select" id="produto" name="produto" required>
                                            <?= $this->data["produtos"] ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Quantidade</label>
                                        <input type="number" data-role="input" value="1" required name="quantidade"
                                               id="quantidade">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card-footer">
                <button type="submit">INCLUIR</button>
            </div>
            </form>
        </div>
    </div>

    <?= $this->start("scripts"); ?>
    <script>
        $(document).ready(function () {

        });
    </script>
    <?= $this->end("scripts"); ?>
