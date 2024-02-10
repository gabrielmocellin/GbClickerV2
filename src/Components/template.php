<?php 
    $titulo       = isset($titulo)? $titulo : 'Gb Clicker';
    $linksCss     = isset($linksCss)? $linksCss : [''];
    $srcJs        = isset($srcJs)? $srcJs : [''];
    $conteudoMain = isset($conteudoMain)? $conteudoMain : '';

    function montarLinks($linksCss)
    {
        foreach ($linksCss as $link) {
            echo "<link rel='stylesheet' href='" . $GLOBALS['prefix'] . $link . "'>";
        }
    }

    function montarScripts($srcJs)
    {
        foreach ($srcJs as $src) {
            echo "<script lang='JavaScript' src='" . $GLOBALS['prefix'] . $src . "'></script>";
        }
    }

?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href='<?= $GLOBALS['prefix'] . 'css/site.css' ?>' />
    <link rel="stylesheet" href='<?= $GLOBALS['prefix'] . 'css/miniNotificacao.css' ?>' />
    <?php montarLinks($linksCss); ?>
    <title><?= $titulo ?></title>
</head>
<body>
    <?php
        require_once('util/header.php');
        //require_once($GLOBALS['prefix'] . 'util/header.php');
    ?>
    <main>
        <?php
            require_once('util/navbar.php');
            require_once('util/miniNotificacao.php');
            require_once($conteudoMain);
            /* require_once($GLOBALS['prefix'] . 'util/navbar.php');
            require_once($GLOBALS['prefix'] . 'util/miniNotificacao.php');
            require_once($GLOBALS['prefix'] . $conteudoMain); */
        ?>
    </main>
    <?php
        require_once('util/importJsScripts.php');
        //require_once($GLOBALS['prefix'] . 'util/importJsScripts.php');
    ?>
    <?php montarScripts($srcJs); ?>
</body>
</html>