<?php
$this->data["empresa"] = EMPRESA;
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from colorlib.com/polygon/admindek/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:30 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <title>ERPCASTRO :: <?= $this->data["empresa"] ?></title>


    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond./assets/js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="/assets/css/waves.min.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="/assets/css/feather.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome-n.min.css">

    <link rel="stylesheet" href="/assets/css/chartist.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/widget.css">
</head>
<body>

<div class="loader-bg">
    <div class="loader-bar"></div>
</div>

<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a href="index.html">
                        <img class="img-fluid" src="png/logo.png" alt="Theme-Logo" />
                    </a>
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-menu icon-toggle-right"></i>
                    </a>
                    <a class="mobile-options waves-effect waves-light">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>
                <div class="navbar-container container-fluid">
                    <ul class="nav-right">
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="/assets/images/a.png" class="img-radius" alt="User-Profile-Image">
                                    <span><?= $usuario ?></span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <a href="/sair">
                                            <i class="feather icon-log-out"></i> Sair
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">

                <nav class="pcoded-navbar">
                    <div class="nav-list">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigation-label">Menu</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="/dashboard" class="waves-effect waves-dark">
                                        <span class="pcoded-micon">
                                        <i class="feather icon-home"></i>
                                        </span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon">
                                        <i class="feather icon-pie-chart"></i>
                                        </span>
                                        <span class="pcoded-mtext">Produtos</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="/produtos/cadastrar" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">Cadastrar</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

               <?= $this->section("content") ?>

                <div id="styleSelector">
                </div>

            </div>
        </div>
    </div>
</div>


<!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade
        <br/>to any of the following web browsers to access this website.
    </p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->


<script type="2d8d78e876b340f9029c575b-text/javascript" src="/assets/js/jquery.min.js"></script>
<script type="2d8d78e876b340f9029c575b-text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="2d8d78e876b340f9029c575b-text/javascript" src="/assets/js/popper.min.js"></script>
<script type="2d8d78e876b340f9029c575b-text/javascript" src="/assets/js/bootstrap.min.js"></script>

<script src="/assets/js/waves.min.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>

<script type="2d8d78e876b340f9029c575b-text/javascript" src="/assets/js/jquery.slimscroll.js"></script>

<script src="/assets/js/jquery.flot.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>
<script src="/assets/js/jquery.flot.categories.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>
<script src="/assets/js/curvedlines.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>
<script src="/assets/js/jquery.flot.tooltip.min.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>

<script src="/assets/js/amcharts.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>
<script src="/assets/js/serial.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>
<script src="/assets/js/light.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>

<script src="/assets/js/markerclusterer.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>
<script type="2d8d78e876b340f9029c575b-text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
<script type="2d8d78e876b340f9029c575b-text/javascript" src="/assets/js/gmaps.js"></script>

<script src="/assets/js/pcoded.min.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>
<script src="/assets/js/vertical-layout.min.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>
<script type="2d8d78e876b340f9029c575b-text/javascript" src="/assets/js/crm-dashboard.min.js"></script>
<script type="2d8d78e876b340f9029c575b-text/javascript" src="/assets/js/script.min.js"></script>
<script src="/assets/js/jquery.mask.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="2d8d78e876b340f9029c575b-text/javascript"></script>
<script type="2d8d78e876b340f9029c575b-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script src="/assets/js/rocket-loader.min.js" data-cf-settings="2d8d78e876b340f9029c575b-|49" defer=""></script></body>
<?= $this->section("scripts") ?>
<!-- Mirrored from colorlib.com/polygon/admindek/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:32 GMT -->
</html>
