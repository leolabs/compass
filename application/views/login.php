<!DOCTYPE html>
<html>
<head>
    <title>ComPass - Sign in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/res/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/res/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>

    <style type="text/css">
        body {
            background-color: #fbfbfb;
            padding-bottom: 40px;
        }

        .navbar-brand {
            text-transform: uppercase;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-signin-heading{
            font-weight: normal;
            margin-top: 35px;
            margin-bottom: 50px;
            text-transform: uppercase;
            color: #666;
            text-align: center;
        }

        .form-signin .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>

</head>
<body>

<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">com<strong>pass</strong></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">About COM<strong>PASS</strong></a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Get an account</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <form class="form-signin" method="POST" action="<?php echo site_url('login/form'); ?>">
        <h2 class="form-signin-heading">com<strong>pass</strong></h2>

        <?php if(isset($status)): ?>
        <div class="alert alert-danger">
            <strong>Error:</strong> Wrong email address or password. Please try again with correct login data.
        </div>
        <?php endif; ?>

        <input type="text" class="form-control" name="mail" placeholder="Email address" autofocus>
        <input type="password" class="form-control" name="password" placeholder="Password">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div>

<script src="/res/js/jquery.min.js"></script>
<script src="/res/js/bootstrap.min.js"></script>

</body>
</html>