<?php
$this->data["empresa"] = EMPRESA;
?>
<!DOCTYPE html>
<html lang="en" class=" scrollbar-type-1 sb-cyan">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Metro 4 -->
    <link rel="stylesheet" href="/assets/css/metro-all.min.css">
    <link rel="stylesheet" href="/assets/css/index.css">

    <title>ERP-CASTRO :: <?= $this->data["empresa"] ?></title>

    <script>
        window.on_page_functions = [];
    </script>

    <style>
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
<body class="m4-cloak h-vh-100">
<div data-role="navview" data-toggle="#paneToggle" data-expand="xl" data-compact="lg" data-active-state="true">
    <div class="navview-pane">
        <div class="bg-cyan d-flex flex-align-center">
            <button class="pull-button m-0 bg-darkCyan-hover">
                <span class="mif-menu fg-white"></span>
            </button>
            <h2 class="text-light m-0 fg-white pl-7" style="line-height: 52px">ERP::CASTRO</h2>
        </div>

        <ul class="navview-menu mt-4" id="side-menu">
            <li onclick="window.location.href='/dashboard'">
                <a href="#">
                    <span class="icon"><span class="mif-meter"></span></span>
                    <span class="caption">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <span class="icon"><span class="mif-versions"></span></span>
                    <span class="caption">Produtos</span>
                </a>
                <ul class="navview-menu stay-open" data-role="dropdown">
                    <li class="item-header">Produtos</li>
                    <li onclick="window.location.href='/produtos/cadastrar'">
                        <a href="#">
                            <span class="icon"><span class="mif-lock"></span></span>
                            <span class="caption">Cadastrar</span>
                        </a></li>
                    <li><a href="register.html">
                            <span class="icon"><span class="mif-user-plus"></span></span>
                            <span class="caption">Relação</span>
                        </a></li>
                </ul>
            </li>
        </ul>

        <div class="w-100 text-center text-small data-box p-2 border-top bd-grayMouse" style="position: absolute; bottom: 0">
            <div>&copy; 2022 :: ERP-CASTRO</div>
            <div>Criado por <a href="https://www.instagram.com/jhuliocastro/" class="text-muted fg-white-hover no-decor">Jhúlio Castro</a></div>
        </div>
    </div>

    <div class="navview-content h-100">
        <div data-role="appbar" class="pos-absolute bg-darkCyan fg-white">

            <a href="#" class="app-bar-item d-block d-none-lg" id="paneToggle"><span class="mif-menu"></span></a>

            <div class="app-bar-container ml-auto">
                <div class="app-bar-container">
                    <a href="#" class="app-bar-item">
                        <img src="/assets/images/a.png" class="avatar">
                        <span class="ml-2 app-bar-name"><?= $usuario ?></span>
                    </a>
                    <div class="user-block shadow-1" data-role="collapse" data-collapsed="true">
                        <div class="bg-darkCyan fg-white p-2 text-center">
                            <img src="/assets/images/a.png" class="avatar">
                            <div class="h4 mb-0"><?= $usuario ?></div>
                            <div>Usuário</div>
                        </div>
                        <div class="bg-white d-flex flex-justify-between flex-equal-items p-2 bg-light">
                            <button disabled class="button mr-1">Profile</button>
                            <button onclick="window.location.href='/sair'" class="button ml-1">Sair</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="padding: 10px;" class="content-inner h-100" style="overflow-y: auto">
            <?= $this->section("content"); ?>
        </div>
    </div>
</div>

<div id="carrega">
    <div id="loader" data-role="activity" data-type="square" data-style="color"></div>
</div>

<!-- jQuery first, then Metro UI JS -->
<script src="/assets/js/jquery-3.4.1.js"></script>
<script src="/assets/js/metro.min.js"></script>
<script src="/assets/js/index.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
<?= $this->section("scripts"); ?>

</body>
</html>