<?php
    /** @var GbClicker\Model\UserModel $model */
    use GbClicker\Controller\ShopController;  
?><!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="img/favicon.png">
        <link rel='stylesheet' href='css/notificacao.css'>
        <link rel='stylesheet' href='css/site.css'>
        <link rel='stylesheet' href='css/shop.css'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <title>Loja</title>
    </head>
    <body>
        <?php require_once "util/notificacao.php"; ?>
        <?php require_once "util/header.php"; ?>
        <main>
            <?php require "util/navbar.php"; ?>
            <div id="shop-div">
                <?php ShopController::mostrarItens($itemsArray); ?>
            </div>
        </main>
        <?php
            ShopController::importShopJs();
            require 'util/importJScreateGame.php';
        ?>
        <script>
            var itensArray = Array();
            <?php ShopController::identificarItens($itemsArray); ?>
        </script>
        <script src='js/Shop/shop.js'></script>
    </body>
</html>