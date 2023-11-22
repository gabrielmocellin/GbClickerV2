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

        <form method="POST" id="form-purchase" action='View/shop/exe/savePurchase.php' style='display:none'>
          <input id='clickValue-input' name='clickValue-input' type='text'>
          <input id='money-input'      name='money-input'      type='text'>
          <input id='multiplier-input' name='multiplier-input' type='text'>
          <input id='minions-input'    name='minions-input'    type='text'>
          <button>Enviar</button>
        </form>

        <script language="JavaScript" src="View/shop/js/Item.js"></script>
        <script language="JavaScript" src="View/shop/js/items/Minion.js"></script>
        <script language="JavaScript" src="View/shop/js/items/Multiplier.js"></script>
        <script language="JavaScript" src="View/shop/js/items/ClickValue.js"></script>
        <script language="JavaScript" src="View/shared/js/navbar.js"></script>
        <script language="JavaScript" src="View/shared/js/User.js"></script>
        <script language="JavaScript" src="View/shared/js/game.js"></script>
        <script language="JavaScript">
          var itensArray = Array();
          var jogo = new game(
            valorDoClique                     = <?= $model->getClickValue(); ?>,
            dinheiro                          = <?= $model->getMoney(); ?>,
            multiplicador                     = <?= $model->getMultiplier(); ?>,
            minions                           = <?= $model->getMinions(); ?>,
            nivel                             = <?= $model->getLevelData()->level; ?>,
            pontosAtuaisDeNivel               = <?= $model->getLevelData()->xp_points; ?>,
            pontosNecessariosParaSubirDeNivel = <?= $model->getLevelData()->max_to_up; ?>
          );
          <?php require "View/shop/exe/identifyItems.php"; ?>
          itensArray.forEach( function(item){ let itemTd = document.getElementById(`item-${item.id}`); itemTd.addEventListener('click', item.comprar.bind(item)); } );
        </script>
    </body>
</html>