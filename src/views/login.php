<?php
$this->data["empresa"] = EMPRESA;
?>

<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no" />
    <title>ERPCASTRO :: <?= $this->data["empresa"] ?></title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon" />  <!-- Bootstrap -->
    <link type="text/css" media="screen" rel="stylesheet" href="/assets/login/bootstrap.min.css" />
    <link type="text/css" media="screen" rel="stylesheet" href="/assets/login/login.css">
    <link type="text/css" media="screen" rel="stylesheet" href="/assets/login/icons.css" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="/assets/login/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/assets/login/bootstrap.min.js"></script>
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <img style="width: 300px;" class="img-responsive" src="/assets/images/logo.png"/>
    </div> <!-- /login-header -->
    <!-- Notification -->
    <div class="login-wrap">
        <div class="login-info"></div>
        <form class="form-vertical" method="post" action="/login">
            <div class="form-group login-input">
                <i class="icon16 icon-app-acl-client overlay">&nbsp;</i>
                <input class="form-control text-input" type="text" name="usuario" id="usuario" placeholder="Usuário">
            </div>
            <div class="form-group login-input">
                <i class="icon16 icon-app-lock overlay">&nbsp;</i>
                <input class="form-control text-input" type="password" name="senha" id="senha" placeholder="Senha">
            </div>
            <button type="submit" class="btn btn-block btn-outline-success">Login</button>
        </form>
    </div>
</div>
<div class="text-center login-extra">
    <span><a href="https://erpcastro.com.br" target="_blank" class="text-dark">Erpcastro</a></span>
    <span>2.0 - Build 2 |</span>
    <span> - </span>
    <span>&copy; 2022 - 2022</span>
</div>
</body>
</html>