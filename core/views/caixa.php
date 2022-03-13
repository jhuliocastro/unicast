<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>
<style>
    #corpo{
        display: flex;
        align-items: stretch;
        background-color: black;
    }
    #caixaAberto {
        background-color: #4e78a2;
        color: white;
        text-align: center;
        font-size: 19px;
        font-weight: bold;
        margin: 10px;
        border-radius: 5px;
        padding: 10px;
    }

    #produtosCaixa {
        background-color: #4e78a2;
        border-radius: 5px;
        padding: 10px;
        bottom: 0px;

    }

    #linhaBaixo{
        margin-right: 10px;
        margin-left: 10px;
        margin-top: 2px;
    }
    body, html{
        height: 100%;
    }

    #main {
        background-color:#FFFFFF;
        width: 100%;
        height: 50em;
        display: flex;
        align-items: flex-end;
    }

    #main div {
        flex: 1;
    }

</style>

    <div id="main">
        <div style="background-color:coral;">This DIV has little content.</div>
        <div style="background-color:lightblue;">This DIV has more content and usually this can be a problem when aligning multiple DIV elements.</div>
        <div style="background-color:lightgreen;">This <br>DIV<br>has<br>many<br>line<br>breaks.</div>
    </div>

<div id="corpo">
    <!--
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="caixaAberto">
                    CAIXA ABERTO
                </div>
            </div>
        </div>
        <div class="row" id="linhaBaixo">
            <div class="cell">
                dfgdfgfdg
            </div>
            <div class="cell" id="produtosCaixa">
                <p>Lista de Produtos</p>
                <br/>
                <input type="text"
                       id="codigoBarrasCaixa"
                       name="codigoBarrasCaixa"
                       placeholder="CÓDIGO DE BARRAS"
                       data-role="input"
                >
            </div>
        </div>
    </div>-->
</div>


<?= $this->start("scripts"); ?>
    <script>
        $(document).ready(function () {
            $("#codigoBarrasCaixa").focus();
        });
    </script>
<?= $this->end("scripts"); ?>