<?php
$this->data["empresa"] = EMPRESA;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>UNICAST :: <?= $this->data["empresa"] ?></title>
    <link rel="stylesheet" href="/assets/css/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.js"
            integrity="sha512-2Pv9x5icS9MKNqqCPBs8FDtI6eXY0GrtBy8JdSwSR4GVlBWeH5/eqXBFbwGGqHka9OABoFDelpyDnZraQawusw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/assets/js/hotkeys.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="/assets/js/w2ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/w2ui.css" />
    <script src="https://kit.fontawesome.com/40a3a65976.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/vendor/datatables/datatables/media/css/jquery.dataTables.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="/vendor/datatables/datatables/media/js/jquery.dataTables.js"></script>

    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script
            src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"
            integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY="
            crossorigin="anonymous"></script>
    <link href="/vendor/snapappointments/bootstrap-select/dist/css/bootstrap-select.css">
    <script src="/vendor/snapappointments/bootstrap-select/dist/js/bootstrap-select.js"></script>
    <style>
        html, body{
            margin: 0;
            padding: 0;
            background-image: url("/assets/images/background.jpg");
            background-size: cover;
            background-repeat: no-repeat;
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
            text-align: center;
        }

        #loader{
            margin: 0 auto;
            top: 48%;
        }

        .spinner {
            margin: 100px auto;
            width: 50px;
            height: 40px;
            text-align: center;
            font-size: 10px;
        }

        .spinner > div {
            background-color: #333;
            height: 100%;
            width: 6px;
            display: inline-block;

            -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
            animation: sk-stretchdelay 1.2s infinite ease-in-out;
        }

        .spinner .rect2 {
            -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s;
        }

        .spinner .rect3 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        .spinner .rect4 {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }

        .spinner .rect5 {
            -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s;
        }

        @-webkit-keyframes sk-stretchdelay {
            0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
            20% { -webkit-transform: scaleY(1.0) }
        }

        @keyframes sk-stretchdelay {
            0%, 40%, 100% {
                transform: scaleY(0.4);
                -webkit-transform: scaleY(0.4);
            }  20% {
                   transform: scaleY(1.0);
                   -webkit-transform: scaleY(1.0);
               }
        }
    </style>
</head>

<body>
<div id="toolbar"></div>
<div id="carrega">
    <div class="spinner">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
</div>
<br/>
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
                        { id: 'clientes', text: 'Clientes', icon: 'fa-solid fa-users', disabled: true },
                        { id: 'empresas', text: 'Empresas', icon: `fa-solid fa-building`, disabled: true },
                        { id: 'caixaDiario', text: 'Caixa Diário', icon: 'fa-solid fa-cash-register' },
                        { id: 'consultaPreco', text: 'Consultar Preços', icon: 'fa-solid fa-search', disabled: true }
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
                        { id: 'orcamento', text: 'Orcamento', icon: 'fa-solid fa-chart-line', disabled: true }
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
                            window.location.href = "/vendas";
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

    w2utils.locale('/assets/locale/pt-br.json');
</script>
<?= $this->section("scripts") ?>
</html>
