<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Default template</title>
    <link rel="stylesheet" href="<?php echo constant('ROOT_PATH'); ?>style/default.css">
    <?php
    if (!isset($noAnim))
    {
            echo '<link rel="stylesheet" href="' . constant('ROOT_PATH') . 'style/anim.css">';
    }
    ?>
    <!-- <script src="script.js"></script> -->
</head>
<body>
<div class="wrapper">
<header>
    <h1 id="title"><a href="<?php echo constant('ROOT_PATH'); ?>">Planning Manager</a></h1>
</header>
<!-- Fin header.php -->
