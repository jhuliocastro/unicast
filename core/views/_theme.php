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
                                        <span class="pcoded-mtext">Charts</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="chart-google.html" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">Google Chart</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="chart-chartjs.html" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">ChartJs</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="pcoded-content">

                    <div class="page-header card">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="feather icon-home bg-c-blue"></i>
                                    <div class="d-inline">
                                        <h5>Dashboard <?= $this->data["empresa"] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-body">

                                    <div class="row">

                                        <div class="col-xl-3 col-md-6">
                                            <div class="card prod-p-card card-red">
                                                <div class="card-body">
                                                    <div class="row align-items-center m-b-30">
                                                        <div class="col">
                                                            <h6 class="m-b-5 text-white">Total Profit</h6>
                                                            <h3 class="m-b-0 f-w-700 text-white">$1,783</h3>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-money-bill-alt text-c-red f-18"></i>
                                                        </div>
                                                    </div>
                                                    <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+11%</span>From Previous Month</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <div class="card prod-p-card card-blue">
                                                <div class="card-body">
                                                    <div class="row align-items-center m-b-30">
                                                        <div class="col">
                                                            <h6 class="m-b-5 text-white">Total Orders</h6>
                                                            <h3 class="m-b-0 f-w-700 text-white">15,830</h3>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-database text-c-blue f-18"></i>
                                                        </div>
                                                    </div>
                                                    <p class="m-b-0 text-white"><span class="label label-primary m-r-10">+12%</span>From Previous Month</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <div class="card prod-p-card card-green">
                                                <div class="card-body">
                                                    <div class="row align-items-center m-b-30">
                                                        <div class="col">
                                                            <h6 class="m-b-5 text-white">Average Price</h6>
                                                            <h3 class="m-b-0 f-w-700 text-white">$6,780</h3>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-dollar-sign text-c-green f-18"></i>
                                                        </div>
                                                    </div>
                                                    <p class="m-b-0 text-white"><span class="label label-success m-r-10">+52%</span>From Previous Month</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <div class="card prod-p-card card-yellow">
                                                <div class="card-body">
                                                    <div class="row align-items-center m-b-30">
                                                        <div class="col">
                                                            <h6 class="m-b-5 text-white">Product Sold</h6>
                                                            <h3 class="m-b-0 f-w-700 text-white">6,784</h3>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-tags text-c-yellow f-18"></i>
                                                        </div>
                                                    </div>
                                                    <p class="m-b-0 text-white"><span class="label label-warning m-r-10">+52%</span>From Previous Month</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-6 col-md-12">
                                            <div class="card latest-update-card">
                                                <div class="card-header">
                                                    <h5>What’s New</h5>
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                            <li><i class="feather icon-maximize full-card"></i></li>
                                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                            <li><i class="feather icon-trash close-card"></i></li>
                                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                                    <div class="latest-update-box">
                                                        <div class="row p-t-20 p-b-30">
                                                            <div class="col-auto text-right update-meta p-r-0">
                                                                <img src="jpg/avatar-4.jpg" alt="user image" class="img-radius img-40 align-top m-r-15 update-icon">
                                                            </div>
                                                            <div class="col p-l-5">
                                                                <a href="#!"><h6>Your Manager Posted.</h6></a>
                                                                <p class="text-muted m-b-0">Jonny michel</p>
                                                            </div>
                                                        </div>
                                                        <div class="row p-b-30">
                                                            <div class="col-auto text-right update-meta p-r-0">
                                                                <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                                            </div>
                                                            <div class="col p-l-5">
                                                                <a href="#!"><h6>You have 3 pending Task.</h6></a>
                                                                <p class="text-muted m-b-0">Hemilton</p>
                                                            </div>
                                                        </div>
                                                        <div class="row p-b-30">
                                                            <div class="col-auto text-right update-meta p-r-0">
                                                                <i class="feather icon-check f-w-600 bg-c-green update-icon"></i>
                                                            </div>
                                                            <div class="col p-l-5">
                                                                <a href="#!"><h6>New Order Received.</h6></a>
                                                                <p class="text-muted m-b-0">Hemilton</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto text-right update-meta p-r-0">
                                                                <img src="jpg/avatar-4.jpg" alt="user image" class="img-radius img-40 align-top m-r-15 update-icon">
                                                            </div>
                                                            <div class="col p-l-5">
                                                                <a href="#!"><h6>Your Manager Posted.</h6></a>
                                                                <p class="text-muted m-b-0">Jonny michel</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-12">
                                            <div class="card new-cust-card">
                                                <div class="card-header">
                                                    <h5>New Customers</h5>
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                            <li><i class="feather icon-maximize full-card"></i></li>
                                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                            <li><i class="feather icon-trash close-card"></i></li>
                                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                                    <div class="align-middle m-b-35">
                                                        <img src="jpg/avatar-2.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                        <div class="d-inline-block">
                                                            <a href="#!"><h6>Alex Thompson</h6></a>
                                                            <p class="text-muted m-b-0">Cheers!</p>
                                                            <span class="status active"></span>
                                                        </div>
                                                    </div>
                                                    <div class="align-middle m-b-35">
                                                        <img src="jpg/avatar-3.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                        <div class="d-inline-block">
                                                            <a href="#!"><h6>John Doue</h6></a>
                                                            <p class="text-muted m-b-0">stay hungry stay foolish!</p>
                                                            <span class="status active"></span>
                                                        </div>
                                                    </div>
                                                    <div class="align-middle m-b-35">
                                                        <img src="jpg/avatar-3.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                        <div class="d-inline-block">
                                                            <a href="#!"><h6>Alex Thompson</h6></a>
                                                            <p class="text-muted m-b-0">Cheers!</p>
                                                            <span class="status deactive text-mute"><i class="far fa-clock m-r-10"></i>30 min ago</span>
                                                        </div>
                                                    </div>
                                                    <div class="align-middle m-b-0">
                                                        <img src="jpg/avatar-2.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                        <div class="d-inline-block">
                                                            <a href="#!"><h6>Alex Thompson</h6></a>
                                                            <p class="text-muted m-b-0">Cheers!</p>
                                                            <span class="status active"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-4 col-md-12">
                                            <div class="card comp-card">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h6 class="m-b-25">Impressions</h6>
                                                            <h3 class="f-w-700 text-c-blue">1,563</h3>
                                                            <p class="m-b-0">May 23 - June 01 (2017)</p>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-eye bg-c-blue"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="card comp-card">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h6 class="m-b-25">Goal</h6>
                                                            <h3 class="f-w-700 text-c-green">30,564</h3>
                                                            <p class="m-b-0">May 23 - June 01 (2017)</p>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-bullseye bg-c-green"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="card comp-card">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h6 class="m-b-25">Impact</h6>
                                                            <h3 class="f-w-700 text-c-yellow">42.6%</h3>
                                                            <p class="m-b-0">May 23 - June 01 (2017)</p>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-hand-paper bg-c-yellow"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-4 col-md-6">
                                            <div class="card o-hidden">
                                                <div class="card-header">
                                                    <h5>Total Leads</h5>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-muted m-b-5">Overall</p>
                                                            <h6>68.52%</h6>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="text-muted m-b-5">Monthly</p>
                                                            <h6>28.90%</h6>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="text-muted m-b-5">Day</p>
                                                            <h6>13.50%</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="sal-income" style="height:100px"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="card o-hidden">
                                                <div class="card-header">
                                                    <h5>Total Vendors</h5>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-muted m-b-5">Overall</p>
                                                            <h6>68.52%</h6>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="text-muted m-b-5">Monthly</p>
                                                            <h6>28.90%</h6>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="text-muted m-b-5">Day</p>
                                                            <h6>13.50%</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rent-income" style="height:100px"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-12">
                                            <div class="card o-hidden">
                                                <div class="card-header">
                                                    <h5>Invoice Generate</h5>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-muted m-b-5">Overall</p>
                                                            <h6>68.52%</h6>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="text-muted m-b-5">Monthly</p>
                                                            <h6>28.90%</h6>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="text-muted m-b-5">Day</p>
                                                            <h6>13.50%</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="income-analysis" style="height:100px"></div>
                                            </div>
                                        </div>


                                        <div class="col-xl-8 col-md-12">
                                            <div class="card latest-update-card">
                                                <div class="card-header">
                                                    <h5>Latest Activity</h5>
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                            <li><i class="feather icon-maximize full-card"></i></li>
                                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                            <li><i class="feather icon-trash close-card"></i></li>
                                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                                    <div class="latest-update-box">
                                                        <div class="row p-t-20 p-b-30">
                                                            <div class="col-auto text-right update-meta">
                                                                <i class="feather icon-sunrise bg-c-blue update-icon"></i>
                                                            </div>
                                                            <div class="col">
                                                                <h6>John Deo</h6>
                                                                <p class="text-muted m-b-15">The trip was an amazing and a life changing experience!!</p>
                                                                <img src="jpg/01.jpg" alt="" class="img-fluid img-100 m-r-15 m-b-10">
                                                                <img src="jpg/03.jpg" alt="" class="img-fluid img-100 m-r-15 m-b-10">
                                                            </div>
                                                        </div>
                                                        <div class="row p-b-30">
                                                            <div class="col-auto text-right update-meta">
                                                                <i class="feather icon-file-text bg-c-blue update-icon"></i>
                                                            </div>
                                                            <div class="col">
                                                                <h6>Administrator</h6>
                                                                <p class="text-muted m-b-0">Free courses for all our customers at A1 Conference Room - 9:00 am tomorrow!</p>
                                                            </div>
                                                        </div>
                                                        <div class="row p-b-30">
                                                            <div class="col-auto text-right update-meta">
                                                                <i class="feather icon-map-pin bg-c-blue update-icon"></i>
                                                            </div>
                                                            <div class="col">
                                                                <h6>Jeny William</h6>
                                                                <p class="text-muted m-b-15">Happy Hour! Free drinks at <span> <a href="#!" class="text-c-blue">Cafe-Bar all </a> </span>day long!</p>
                                                                <div id="markers-map" style="height:245px;width:100%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <a href="#!" class=" b-b-primary text-primary">View all Activity</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-12">
                                            <div class="card chat-card">
                                                <div class="card-header">
                                                    <h5>Chat history</h5>
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                            <li><i class="feather icon-maximize full-card"></i></li>
                                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                            <li><i class="feather icon-trash close-card"></i></li>
                                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row m-b-20 received-chat">
                                                        <div class="col-auto p-r-0">
                                                            <img src="jpg/avatar-2.jpg" alt="user image" class="img-radius img-40">
                                                        </div>
                                                        <div class="col">
                                                            <div class="msg">
                                                                <p class="m-b-0">Nice to meet you!</p>
                                                            </div>
                                                            <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-20 send-chat">
                                                        <div class="col">
                                                            <div class="msg">
                                                                <p class="m-b-0">Nice to meet you!</p>
                                                            </div>
                                                            <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                                                        </div>
                                                        <div class="col-auto p-l-0">
                                                            <img src="jpg/avatar-3.jpg" alt="user image" class="img-radius img-40">
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-20 received-chat">
                                                        <div class="col-auto p-r-0">
                                                            <img src="jpg/avatar-2.jpg" alt="user image" class="img-radius img-40">
                                                        </div>
                                                        <div class="col">
                                                            <div class="msg">
                                                                <p class="m-b-0">Nice to meet you!</p>
                                                                <img src="jpg/01.jpg" alt="">
                                                                <img src="jpg/03.jpg" alt="">
                                                            </div>
                                                            <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-20 send-chat">
                                                        <div class="col">
                                                            <div class="msg">
                                                                <p class="m-b-0">Come now to meet you!</p>
                                                            </div>
                                                            <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                                                        </div>
                                                        <div class="col-auto p-l-0">
                                                            <img src="jpg/avatar-3.jpg" alt="user image" class="img-radius img-40">
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-20 received-chat">
                                                        <div class="col-auto p-r-0">
                                                            <img src="jpg/avatar-2.jpg" alt="user image" class="img-radius img-40">
                                                        </div>
                                                        <div class="col">
                                                            <div class="msg">
                                                                <p class="m-b-0">Nice to meet you!</p>
                                                                <img src="jpg/03.jpg" alt="">
                                                            </div>
                                                            <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                                                        </div>
                                                    </div>
                                                    <div class="right-icon-control">
                                                        <div class="input-group input-group-button">
                                                            <input type="text" class="form-control" placeholder="Send message">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-primary waves-effect waves-light" type="button"><i class="feather icon-message-circle"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="2d8d78e876b340f9029c575b-text/javascript"></script>
<script type="2d8d78e876b340f9029c575b-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script src="/assets/js/rocket-loader.min.js" data-cf-settings="2d8d78e876b340f9029c575b-|49" defer=""></script></body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:32 GMT -->
</html>
