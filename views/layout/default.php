<!DOCTYPE html>
<html lang="fr">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gestion de planning">
    <meta name="author" content="Benoit Branchard - Ludovic Graveaud - Flavian Mary">

    <title><?php
        if (isset($title))
        {
            echo $title;
        }
        else
        {
            echo 'Planning manager';
        }
        ?></title>

    <!-- Bootstrap Twitter Core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT . 'style/bootstrap.css'; ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT . 'style/bootstrap-theme.css'; ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT . 'style/default.css'; ?>"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT . 'scripts/bootstrap.js'; ?>"></script>

</head>

<body role="document">
<div id="wrap">
    <header class="navbar-inverse">
        <div class="container">
            <div class="center-block">
                <h1 class="text-center"><a class="navbar-brand" href="<?php echo WEBROOT; ?>">Planning Manager</a></h1>
            </div>
        </div>
    </header>
    <section class="container">
        <?php echo $content_for_layout; ?>
        <?php if(Configure::$debug_mode === 2): ?>
            <h2>Debug :</h2>
            <?php var_dump($_SESSION) ?>
        <?php endif; ?>
    </section>

</div>
<footer class="footer">
    <div class="container">
        <p class="text-center">
            Flavian Mary - Benoit Branchard - Ludovic Graveaud
        </p>
    </div>
</footer>
</body>
</html>