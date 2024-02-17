<?php
    /** @var GbClicker\Model\UserModel $model */
    use GbClicker\Controller\ShopController;  
?><!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="img/favicon.png">
        <link rel='stylesheet' href='css/site.css'>
        <link rel='stylesheet' href='css/shop.css'>
        <link rel="stylesheet" href="../css/miniNotificacao.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <title>Loja</title>
    </head>
    <body>
        <?php require_once "util/header.php"; ?>
        <main>
            <?php require "util/navbar.php"; ?>
            <?php require_once "util/miniNotificacao.php"; ?>
            <div id="shop-div">
                <?php ShopController::mostrarItens($itemsArray); ?>
            </div>
        </main>
        <script lang='JavaScript' src='<?= $GLOBALS['prefix'] ?>js/util/miniNotificacao.js'></script>
        <?php
            require 'util/importJsScripts.php';
            ShopController::importShopJs();
        ?>
        <script>
            var itensArray = Array();
            <?php ShopController::identificarItens($itemsArray); ?>
        </script>
    </body>
</html>