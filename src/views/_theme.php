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

    <script type="text/javascript" src="https://rawgit.com/vitmalina/w2ui/master/dist/w2ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://rawgit.com/vitmalina/w2ui/master/dist/w2ui.min.css" />
    <script src="https://kit.fontawesome.com/40a3a65976.js" crossorigin="anonymous"></script>

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
<!--<nav data-role="ribbonmenu">
    <ul class="tabs-holder">
        <li class="static"><a href="/dashboard">Dashboard</a></li>
        <li><a href="#inicio">Início</a></li>
        <li><a href="#fiscal">Fiscal</a></li>
        <li><a href="#financeiro">Financeiro</a></li>
        <li><a href="#relatorios">Relatórios</a></li>
        <li><a href="#pdv">PDV</a></li>
        <li><a href="#configuracoes">Configurações</a></li>
    </ul>

    <div class="content-holder">

        <div class="section" id="relatorios">
            <button class="ribbon-button" onclick="window.location.href='/relatorios/caixaDiario'">
                <span class="icon">
                    <img src="/assets/images/caixa.png">
                </span>
                <span class="caption">Caixa Diário</span>
            </button>
        </div>

    </div>
</nav>-->
<div id="toolbar"></div>
<div style="height: 20px"></div>
<div id="carrega">
    <div id="loader" data-role="activity" data-type="atom" data-style="color"></div>
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

    query(() => {
        new w2toolbar({
            box: query('#toolbar')[0],
            name: 'toolbar',
            items: [
                { type: 'menu', id: 'inicio', text: 'Início',
                    items: [
                        { id: 'produtos', text: 'Produtos', icon: 'fa-solid fa-barcode' },
                        { id: 'clientes', text: 'Clientes', icon: 'fa-solid fa-users' },
                        { id: 'empresas', text: 'Empresas', icon: `fa-solid fa-building` },
                        { id: 'caixaDiario', text: 'Caixa Diário', icon: 'fa-solid fa-cash-register' },
                        { id: 'consultaPreco', text: 'Consultar Preços', icon: 'fa-solid fa-search' }
                    ]
                },
                { type: 'break' },
                { type: 'menu', id: 'fiscal', text: 'Fiscal',
                    items: [
                        { id: 'nfe', text: 'NFe', icon: 'fa-solid fa-file-invoice' }
                    ]
                },
                { type: 'break' },
                { type: 'menu', id: 'pdv', text: 'PDV',
                    items: [
                        { id: 'caixa', text: 'Caixa', icon: 'fa-solid fa-cash-register' },
                        { id: 'orcamento', text: 'Orcamento', icon: 'fa-solid fa-chart-line' }
                    ]
                },
                { type: 'break' },
                { type: 'menu', id: 'financeiro', text: 'Financeiro',
                    items: [
                        { id: 'boletos', text: 'Boletos', icon: 'fa-solid fa-barcode' }
                    ]
                },
                { type: 'break' },
                { type: 'menu', id: 'relatorios', text: 'Relatórios',
                    items: [
                        { id: 'relCaixaDiario', text: 'Caixa Diário', icon: 'fa-solid fa-cash-register' },
                        { id: 'vendas', text: 'Vendas', icon: 'fa-solid fa-file-invoice' }
                    ]
                },
            ],
            onClick(event) {
                event.done(() => {
                    switch (event.detail.item.selected){
                        case 'produtos':
                            window.location.href = "/produtos/relacao";
                            break;
                        case 'clientes':
                            window.location.href = "/clientes/relacao";
                            break;
                        case 'empresas':
                            window.location.href = "/empresas";
                            break;
                        case 'caixaDiario':
                            window.location.href = "/caixaDiario";
                            break;
                        case 'consultaPreco':
                            window.location.href = "/consultaPreco";
                            break;
                        case 'nfe':
                            window.location.href = "/nfe";
                            break;
                        case 'caixa':
                            window.location.href = "/pdv/caixa";
                            break;
                        case 'orcamento':
                            window.location.href = "/pdv/orcamento";
                            break;
                        case 'vendas':
                            window.location.href = "/pdv/vendas";
                            break;
                        case 'boletos':
                            window.location.href = "/boletos";
                            break;
                        case 'relCaixaDiario':
                            window.location.href = "/relatorios/caixaDiario";
                            break;
                    }
                });
            }
        });
    });

</script>
<?= $this->section("scripts") ?>
</html>
