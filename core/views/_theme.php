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
            <li>
                <a href="/dashboard">
                    <span class="icon"><span class="mif-meter"></span></span>
                    <span class="caption">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <span class="icon"><span class="mif-versions"></span></span>
                    <span class="caption">Sample Pages</span>
                </a>
                <ul class="navview-menu stay-open" data-role="dropdown">
                    <li class="item-header">Pages</li>
                    <li><a href="login.html">
                            <span class="icon"><span class="mif-lock"></span></span>
                            <span class="caption">Login</span>
                        </a></li>
                    <li><a href="register.html">
                            <span class="icon"><span class="mif-user-plus"></span></span>
                            <span class="caption">Register</span>
                        </a></li>
                    <li><a href="lockscreen.html">
                            <span class="icon"><span class="mif-key"></span></span>
                            <span class="caption">Lock screen</span>
                        </a></li>
                    <li><a href="#profile">
                            <span class="icon"><span class="mif-profile"></span></span>
                            <span class="caption">Profile</span>
                        </a></li>
                    <li><a href="preloader.html">
                            <span class="icon"><span class="mif-spinner"></span></span>
                            <span class="caption">Preloader</span>
                        </a></li>
                    <li><a href="404.html">
                            <span class="icon"><span class="mif-cancel"></span></span>
                            <span class="caption">404 Page</span>
                        </a></li>
                    <li><a href="500.html">
                            <span class="icon"><span class="mif-warning"></span></span>
                            <span class="caption">500 Page</span>
                        </a></li>
                    <li><a href="#product-list">
                            <span class="icon"><span class="mif-featured-play-list"></span></span>
                            <span class="caption">Product list</span>
                        </a></li>
                    <li><a href="#product">
                            <span class="icon"><span class="mif-rocket"></span></span>
                            <span class="caption">Product page</span>
                        </a></li>
                    <li><a href="#invoice">
                            <span class="icon"><span class="mif-open-book"></span></span>
                            <span class="caption">Invoice</span>
                        </a></li>
                    <li><a href="#orders">
                            <span class="icon"><span class="mif-table"></span></span>
                            <span class="caption">Orders</span>
                        </a></li>
                    <li><a href="#order-details">
                            <span class="icon"><span class="mif-library"></span></span>
                            <span class="caption">Order details</span>
                        </a></li>
                    <li><a href="#price-table">
                            <span class="icon"><span class="mif-table"></span></span>
                            <span class="caption">Price table</span>
                        </a></li>
                    <li><a href="maintenance.html">
                            <span class="icon"><span class="mif-cogs"></span></span>
                            <span class="caption">Maintenance</span>
                        </a></li>
                    <li><a href="coming-soon.html">
                            <span class="icon"><span class="mif-watch"></span></span>
                            <span class="caption">Coming soon</span>
                        </a></li>
                    <li>
                        <a href="help-center.html">
                            <span class="icon"><span class="mif-help"></span></span>
                            <span class="caption">Help center</span>
                        </a>
                    </li>
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
                        <img src="images/jek_vorobey.jpg" class="avatar">
                        <span class="ml-2 app-bar-name">Jack Sparrow</span>
                    </a>
                    <div class="user-block shadow-1" data-role="collapse" data-collapsed="true">
                        <div class="bg-darkCyan fg-white p-2 text-center">
                            <img src="images/jek_vorobey.jpg" class="avatar">
                            <div class="h4 mb-0">Jack Sparrow</div>
                            <div>Pirate captain</div>
                        </div>
                        <div class="bg-white d-flex flex-justify-between flex-equal-items p-2">
                            <button class="button flat-button">Followers</button>
                            <button class="button flat-button">Sales</button>
                            <button class="button flat-button">Friends</button>
                        </div>
                        <div class="bg-white d-flex flex-justify-between flex-equal-items p-2 bg-light">
                            <button class="button mr-1">Profile</button>
                            <button class="button ml-1">Sign out</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="content-wrapper" class="content-inner h-100" style="overflow-y: auto"></div>
    </div>
</div>

<div id="carrega">
    <div id="loader" data-role="activity" data-type="square" data-style="color"></div>
</div>

<!-- jQuery first, then Metro UI JS -->
<script src="/assets/js/jquery-3.4.1.js"></script>
<script src="/assets/js/metro.min.js"></script>
<script src="/assets/js/index.js"></script>
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