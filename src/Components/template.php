<?php
    $titulo = isset($titulo)? $titulo : 'Gb Clicker';
    $linksCss = isset($linksCss)? $linksCss : [''];
    $srcJs = isset($srcJs)? $srcJs : [''];
    $conteudoMain = isset($conteudoMain)? $conteudoMain : '';

    function montarLinks($linksCss)
    {
        foreach ($linksCss as $link) {
            echo "<link rel='stylesheet' href='/" . $link . "'>";
        }
    }

    function montarScripts($srcJs)
    {
        foreach ($srcJs as $src) {
            echo "<script src='/". $src . "'></script>";
        }
    }

?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href='/css/site.css' />
    <link rel="stylesheet" href='/css/miniNotificacao.css' />
    <?php montarLinks($linksCss); ?>
    <link rel="stylesheet" href='/css/dark-mode.css' />
    <script>
        if (localStorage.getItem('gbclicker_night_mode') === 'true') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
    <title><?= $titulo ?></title>
</head>
<body>
    <?php require_once('util/loader.php'); ?>
    <?php require_once('util/header.php'); ?>
    <main>
        <?php
            require_once('util/navbar.php');
            require_once('util/miniNotificacao.php');
            require_once($conteudoMain);
        ?>
    </main>
    <?php require_once('util/importJsScripts.php'); ?>
    <?php montarScripts($srcJs); ?>
</body>
</html>
