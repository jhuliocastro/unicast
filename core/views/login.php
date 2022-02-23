<?php
$this->data["empresa"] = EMPRESA;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Metro 4 -->
    <link rel="stylesheet" href="/assets/css/metro-all.min.css">
    <link rel="stylesheet" href="/assets/css/index.css">

    <title>ERP-CASTRO :: <?= $this->data["empresa"] ?></title>
</head>
<body class="m4-cloak h-vh-100 d-flex flex-justify-center flex-align-center">

<div class="login-box">
    <form class="bg-white p-4"
          data-role="validator"
          data-clear-invalid="2000"
          data-on-error-form="invalidForm"
          action="/login"
          method="post"
    >
        <img src="/assets/images/logo.png" class="mt-4-minus mr-6-minus">
        <br/><br/>
        <div class="form-group">
            <input id="usuario" name="usuario" type="text" data-role="input" placeholder="Usuário" data-validate="required">
            <span class="invalid_feedback">Insira um usuário válido</span>
        </div>
        <div class="form-group">
            <input id="senha" name="senha" type="password" data-role="input" placeholder="Senha" data-validate="required">
            <span class="invalid_feedback">Insira uma senha válida</span>
        </div>
        <div class="form-group d-flex flex-align-center flex-justify-between">
            <button style="width: 100%;" class="button primary">Entrar</button>
        </div>
    </form>
</div>


<script src="/assets/js/jquery-3.6.0.js"></script>
<script src="/assets/js/metro.min.js"></script>
<script>
    $(document).ready(function(){
        $("#usuario").focus();
    });

    function invalidForm(){
        var form  = $(this);
        //form.addClass("ani-ring");
        setTimeout(function(){
            form.removeClass("ani-ring");
        }, 1000);
    }
</script>
</body>
</html>