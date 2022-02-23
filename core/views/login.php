<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Metro 4 -->
    <link rel="stylesheet" href="/assets/css/metro-all.min.css">
    <link rel="stylesheet" href="/assets/css/index.css">

    <title>Pandora :: Log in</title>
</head>
<body class="m4-cloak h-vh-100 d-flex flex-justify-center flex-align-center">

<div class="login-box">
    <form class="bg-white p-4"
          action="javascript:"
          data-role="validator"
          data-clear-invalid="2000"
          data-on-error-form="invalidForm"
    >
        <img src="images/p-120x120.png" class="place-right mt-4-minus mr-6-minus">
        <h1 class="mb-0">Login</h1>
        <div class="text-muted mb-4">Sign in to start your session</div>
        <div class="form-group">
            <input type="text" data-role="input" placeholder="Email" data-append="<span class='mif-envelop'>" data-validate="required">
            <span class="invalid_feedback">Please enter a valid email address</span>
        </div>
        <div class="form-group">
            <input type="password" data-role="input" placeholder="Password" data-append="<span class='mif-key'>" data-validate="required">
            <span class="invalid_feedback">Please enter a password</span>
        </div>
        <div class="form-group d-flex flex-align-center flex-justify-between">
            <input type="checkbox" data-role="checkbox" data-caption="Remember Me">
            <button class="button primary">Sign In</button>
        </div>
        <div class="text-center m-4">- OR -</div>
        <div class="form-group">
            <button class="image-button w-100 mt-1 bg-facebook fg-white" type="button">
                <span class="mif-facebook icon"></span>
                <span class="caption">Sign In using Facebook</span>
            </button>
            <button class="image-button w-100 mt-1 bg-github fg-white" type="button">
                <span class="mif-github icon"></span>
                <span class="caption">Sign In using GitHub</span>
            </button>
            <button class="image-button w-100 mt-1 bg-gitlab fg-white" type="button">
                <span class="mif-gitlab icon"></span>
                <span class="caption">Sign In using GitLab</span>
            </button>
        </div>
        <div class="form-group border-top bd-default pt-2">
            <a href="#" class="d-block">I forgot my password</a>
            <a href="#" class="d-block">Register a new membership</a>
        </div>
    </form>
</div>


<script src="/assets/js/jquery-3.6.0.js"></script>
<script src="/assets/js/metro.min.js"></script>
<script>
    function invalidForm(){
        var form  = $(this);
        form.addClass("ani-ring");
        setTimeout(function(){
            form.removeClass("ani-ring");
        }, 1000);
    }
</script>
</body>
</html>