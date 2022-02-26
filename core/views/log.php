<?php
$this->layout("_theme", $this->data);
?>
<div class="row border-bottom bd-lightGray m-3">
    <div class="cell-md-4 d-flex flex-align-center">
        <h3 class="dashboard-section-title text-center text-left-md w-100">Log</h3>
    </div>
</div>
<div class="row">
    <div class="cell-md-12">
        <form method="post" action="/produtos/cadastrar">
            <div class="card">
                <div class="card-content p-2">
                    <div class="row">
                        <table data-role="table" class="table table-border cell-border" style="width: 100%;">
                            <thead>
                                <th>ID</th>
                                <th>EVENTO</th>
                                <th>USUÁRIO</th>
                                <th>IP</th>
                                <th>DATA/HORA</th>
                            </thead>
                            <tbody>
                                <?= $this->data["tabela"] ?>
                            </tbody>
                        </table>
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

<?= $this->end("scripts"); ?>
