<?php
    /** @var UserModel $model */
?>  
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='View/shared/style/site.css'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <title>Gb Clicker II</title>
    </head>
    <body>
      <?php require "View/shared/header.php"; ?>
      <main>
          <?php require "View/shared/navbar.php"; ?>
          <div id="shop-div">
              <table id="shop-table">
                  <tr class='tableHead'> <th>Loja</th> </tr>
                    <?php require "View/shop/exe/showItems.php"; ?>
              </table>
          </div>
      </main>

      <script language="JavaScript" src="View/shop/js/Item.js"></script>
      <script language="JavaScript" src="View/shop/js/items/Minion.js"></script>
      <script language="JavaScript" src="View/shop/js/items/Multiplier.js"></script>
      <script language="JavaScript" src="View/shop/js/items/ClickValue.js"></script>
      <?php require 'View/shared/importJScreateGame.php'; ?>
      <script>
        var itensArray = Array();
        <?php require "View/shop/exe/identifyItems.php"; ?>
        itensArray.forEach( function(item){ let itemTd = document.getElementById(`item-${item.id}`); itemTd.addEventListener('click', item.comprar.bind(item)); } );
      </script>
    </body>
</html>