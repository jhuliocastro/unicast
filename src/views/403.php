
<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<style>
    @import url("https://fonts.googleapis.com/css?family=Lato");
    body {
        height: 100vh;
        align-items: center;
        background: linear-gradient(to bottom right, #eee, #aaa);
    }

    h1 {
        margin: 40px 0 20px;
    }

    .lock {
        border-radius: 5px;
        width: 55px;
        height: 45px;
        background-color: #333;
        animation: dip 1s;
        animation-delay: 1.5s;
    }
    .lock::before, .lock::after {
        content: "";
        position: absolute;
        border-left: 5px solid #333;
        height: 20px;
        width: 15px;
        left: calc(50% - 12.5px);
    }
    .lock::before {
        top: -30px;
        border: 5px solid #333;
        border-bottom-color: transparent;
        border-radius: 15px 15px 0 0;
        height: 30px;
        animation: lock 2s, spin 2s;
    }
    .lock::after {
        top: -10px;
        border-right: 5px solid transparent;
        animation: spin 2s;
    }

    @keyframes lock {
        0% {
            top: -45px;
        }
        65% {
            top: -45px;
        }
        100% {
            top: -30px;
        }
    }
    @keyframes spin {
        0% {
            transform: scaleX(-1);
            left: calc(50% - 30px);
        }
        65% {
            transform: scaleX(1);
            left: calc(50% - 12.5px);
        }
    }
    @keyframes dip {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(10px);
        }
        100% {
            transform: translateY(0px);
        }
    }
</style>

<div class="pcoded-content container-fluid" style="text-align: center;">
    <img src="/assets/images/lock.svg">
    <div class="message">
        <h1>Você não tem permissão para acessar essa função!</h1>
        <p>Por favor, verifique com o administrador do sistema se você acredita que isso é um erro.</p>
    </div>
</div>

<?= $this->start("scripts"); ?>
<script>
    $(document).ready(function () {


    });

</script>
<?= $this->end("scripts"); ?>
