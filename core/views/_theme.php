<?php
$this->data["empresa"] = EMPRESA;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>ERPCASTRO :: <?= $this->data["empresa"] ?></title>
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script
            src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"
            integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.js"
            integrity="sha512-2Pv9x5icS9MKNqqCPBs8FDtI6eXY0GrtBy8JdSwSR4GVlBWeH5/eqXBFbwGGqHka9OABoFDelpyDnZraQawusw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .card-header {
            font-weight: bold;
            background-color: #0a6aa1;
        }
    </style>
</head>
<body>
<nav data-role="ribbonmenu">
    <ul class="tabs-holder">
        <li class="static"><a href="#">Dashboard</a></li>
        <li><a href="#produtos">Produtos</a></li>
        <li><a href="#estoque">Estoque</a></li>
        <li><a href="#configuracoes">Configurações</a></li>
    </ul>

    <div class="content-holder">
        <div class="section" id="produtos">
            <button class="ribbon-button" onclick="window.location.href='/produtos/cadastrar'">
                <span class="icon">
                    <img src="/assets/images/cadastrar.png">
                </span>
                <span class="caption">Cadastrar</span>
            </button>
            <button class="ribbon-button" onclick="window.location.href='/produtos/relacao'">
                <span class="icon">
                    <img src="/assets/images/relacao.png">
                </span>
                <span class="caption">Relação</span>
            </button>
        </div>
        <div class="section" id="estoque">
            <button class="ribbon-button" onclick="window.location.href='/estoque/relacao'">
                <span class="icon">
                    <img src="/assets/images/relacao.png">
                </span>
                <span class="caption">Relação</span>
            </button>
        </div>
        <div class="section" id="configuracoes">
            <button class="ribbon-button" onclick="window.location.href='/produtos/relacao'">
                <span class="icon">
                    <img src="/assets/images/relacao.png">
                </span>
                <span class="caption">Log</span>
            </button>
        </div>
    </div>
</nav>
<?= $this->section("content") ?>
</body>
<?= $this->section("scripts") ?>
</html>
