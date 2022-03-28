<?php
$this->data["empresa"] = EMPRESA;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>ERPCASTRO :: <?= $this->data["empresa"] ?></title>
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
    <link rel="stylesheet" href="/assets/css/jquery-ui.css">
    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script
            src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"
            integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.js"
            integrity="sha512-2Pv9x5icS9MKNqqCPBs8FDtI6eXY0GrtBy8JdSwSR4GVlBWeH5/eqXBFbwGGqHka9OABoFDelpyDnZraQawusw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/assets/js/hotkeys.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/ju/dt-1.11.5/datatables.min.js"></script>

    <style>
        .card-header {
            font-weight: bold;
            background-color: #0a6aa1;
            color: white;
        }

        .imagem-acao{
            width: 30px;
        }
        #carrega{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: white;
        }

        #loader{
            margin: 0 auto;
            top: 48%;
        }
    </style>
</head>

<body>
<nav data-role="ribbonmenu">
    <ul class="tabs-holder">
        <li class="static"><a href="#">Dashboard</a></li>
        <li><a href="#inicio">Início</a></li>
        <li><a href="#clientes">Clientes</a></li>
        <li><a href="#compras">Compras</a></li>
        <li><a href="#pdv">PDV</a></li>
        <li><a href="#configuracoes">Configurações</a></li>
    </ul>

    <div class="content-holder">
        <div class="section" id="clientes">
            <button class="ribbon-button" onclick="window.location.href='/clientes/cadastrar'">
                <span class="icon">
                    <img src="/assets/images/cadastrar.png">
                </span>
                <span class="caption">Cadastrar</span>
            </button>
            <button class="ribbon-button" onclick="window.location.href='/clientes/relacao'">
                <span class="icon">
                    <img src="/assets/images/clientes.png">
                </span>
                <span class="caption">Relação</span>
            </button>
        </div>
        <div class="section" id="inicio">
            <button class="ribbon-button" onclick="window.location.href='/produtos/relacao'">
                <span class="icon">
                    <img src="/assets/images/produtos.png">
                </span>
                <span class="caption">Produtos</span>
            </button>
            <button class="ribbon-button" onclick="window.location.href='/estoque/relacao'">
                <span class="icon">
                    <img src="/assets/images/estoque.png">
                </span>
                <span class="caption">Estoque</span>
            </button>
            <button class="ribbon-button" onclick="window.location.href='/obras'">
                <span class="icon">
                    <img src="/assets/images/obras.png">
                </span>
                <span class="caption">Obras</span>
            </button>
        </div>
        <div class="section" id="estoque">
            <button class="ribbon-button" onclick="window.location.href='/estoque/entrada'">
                <span class="icon">
                    <img src="/assets/images/entradaEstoque.png">
                </span>
                <span class="caption">Entrada</span>
            </button>
        </div>
        <div class="section" id="compras">
            <button class="ribbon-button" onclick="window.location.href='/nfe'">
                <span class="icon">
                    <img src="/assets/images/nfe.svg">
                </span>
                <span class="caption">Importar NFe</span>
            </button>
        </div>
        <div class="section" id="pdv">
            <button class="ribbon-button" onclick="window.location.href='/pdv/caixa'">
                <span class="icon">
                    <img src="/assets/images/caixa.png">
                </span>
                <span class="caption">Caixa</span>
            </button>
            <button class="ribbon-button" onclick="window.location.href='/pdv/orcamento'">
                <span class="icon">
                    <img src="/assets/images/orcamento.png">
                </span>
                <span class="caption">Orçamento</span>
            </button>
            <button class="ribbon-button" onclick="window.location.href='/pdv/vendas'">
                <span class="icon">
                    <img src="/assets/images/vendas.png">
                </span>
                <span class="caption">Vendas</span>
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
<div id="carrega">
    <div id="loader" data-role="activity" data-type="square" data-style="color"></div>
</div>
<?= $this->section("content") ?>
</body>
<script>
    $(window).on("load", function(){
        desloader();
    });

    function desloader(){
        $("#loader").delay(500).fadeOut("slow");
        $("#carrega").delay(500).fadeOut("slow");
    }

    function loader(){
        $("#loader").delay(100).fadeIn("slow");
        $("#carrega").delay(100).fadeIn("slow");
    }
</script>
<?= $this->section("scripts") ?>
</html>
