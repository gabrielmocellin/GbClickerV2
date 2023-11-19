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
        <?php 
            require "View/shared/header.php";
        ?>
        <main>
            <?php require "View/shared/navbar.php"; ?>
            <div id="shop-div">
                <table id="shop-table">
                    <tr class='tableHead'> <th>Loja</th> </tr>
                      <tr>
                      <?php
                        if(!empty($itemsArray)):
                          foreach($itemsArray as $item):
                      ?>

                          <td id="item-<?=$item['id']?>" title="<?=$item['descricao']?>">
                          <div>
                            <img style="height:auto; max-width:100%; border-radius:100%; padding:2rem;" src=<?=$item['image_src']?>>
                            <p><?=$item['nome']?></p>
                            <p>R$ <?=$item['preco']?></p>
                          </div>
                        </td>

                      <?php 
                        endforeach;
                        else:
                      ?>
                        <td>
                          <p>Não há itens disponíveis no momento...</p>
                        </td>
                      <?php endif;?>
                      </tr> 
                </table>
            </div>
        </main>

        <form method="POST" id="form-purchase" action='View/shop/exe/savePurchase.php' style='display:none'>
          <input id='clickValue-input' name='clickValue-input' type='text'>
          <input id='money-input' name='money-input' type='text'>
          <input id='multiplier-input' name='multiplier-input' type='text'>
          <button>Enviar</button>
        </form>

        <script language="JavaScript" src="View/shop/js/Item.js"></script>
        <script language="JavaScript" src="View/shop/js/items/Minion.js"></script>
        <script language="JavaScript" src="View/shop/js/items/Multiplier.js"></script>
        <script language="JavaScript" src="View/shop/js/items/ClickValue.js"></script>
        <script language="JavaScript" src="View/shop/js/XhrShop.js"></script>
        <script language="JavaScript" src="View/shared/js/navbar.js"></script>
        <script language="JavaScript" src="View/shared/js/game.js"></script>
        <script language="JavaScript">
          var itensArray = Array();
          var xhrShop = new XhrShop();
          var jogo = new game(
              clickValue = <?=$model->clickValue;?>,
              userMoney  = <?=$model->money;?>,
              multiplier = <?=$model->multiplier;?>,
              level      = <?=$model->level_data->level;?>,
              xp_points  = <?=$model->level_data->xp_points;?>,
              max_to_up  = <?=$model->level_data->max_to_up;?>
          );

          <?php if($itemsArrayNotNull): foreach($itemsArray as $item): ?>
            <?php if($item['id'] == 6): ?>
              itensArray.push( new Multiplier(<?=$item['id']?>, <?=$item['preco']?>, <?=$item['minimum_level']?>, <?=$item['quantidade']?>) );
            <?php elseif($item['id'] == 7): ?>
              itensArray.push( new Minion(<?=$item['id']?>, <?=$item['preco']?>, <?=$item['minimum_level']?>, <?=$item['quantidade']?>) );
            <?php else: ?>
              itensArray.push( new ClickValue(<?=$item['id']?>, <?=$item['preco']?>, <?=$item['minimum_level']?>, <?=$item['quantidade']?>))


          <?php endif; endforeach; endif; ?>

          itensArray.forEach(function(item){
              let itemTd = document.getElementById(`item-${item.id}`);
              itemTd.addEventListener('click', item.comprar.bind(item)); // bind é utilizado para dizer para a função que o "this" se refere ao objeto, e não o "td".
            });

        </script>
    </body>
</html>