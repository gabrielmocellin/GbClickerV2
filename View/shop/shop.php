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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <title>Loja</title>
    </head>
    <body>
        <?php require_once "util/header.php"; ?>
        <main>
            <?php require "util/navbar.php"; ?>
            <div id="shop-div">
                <table id="shop-table">
                    <tr class='tableHead'> <th>Loja</th> </tr>
                    <?php ShopController::mostrarItens($itemsArray); ?>
                </table>
            </div>
        </main>

      <script language="JavaScript" src="js/Shop/Item.js"></script>
      <script language="JavaScript" src="js/Shop/items/Minions.js"></script>
      <script language="JavaScript" src="js/Shop/items/Multiplier.js"></script>
      <script language="JavaScript" src="js/Shop/items/ClickValue.js"></script>
      <?php require 'util/importJScreateGame.php'; ?>
      <script>
        var itensArray = Array();
        <?php ShopController::identificarItens($itemsArray); ?>
        itensArray.forEach( function(item){ let itemTd = document.getElementById(`item-${item.id}`); itemTd.addEventListener('click', item.comprar.bind(item)); } );
      </script>
    </body>
</html>