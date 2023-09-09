<?php
    /** @var UserModel $model */
    class item{
      public $name;
      public $value;
      public $image_src;

      public function __construct($name_param, $value_param, $image_src_param){
        $this->name = $name_param;
        $this->value = $value_param;
        $this->image_src = $image_src_param;
      }
    }

    $items = array(
      new item("Gb", 100, "View/pages/shared/icons/account.png"),
      new item("Gb2", 1000, "View/pages/shared/icons/account.png"),
      new item("Gb++", 500, "View/pages/shared/icons/account.png"),
      new item("Gb++", 500, "View/pages/shared/icons/account.png")
    );
?>  
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='View/pages/shared/style/site.css'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <title>Gb Clicker II</title>
    </head>
    <body>
        <?php 
            require "View/pages/shared/header.php";
        ?>
        <main>
            <?php require "View/pages/shared/navbar.php"; ?>
            <div id="shop-div">
                <table id="shop-table">
                    <tr class='tableHead'> <th>Loja</th> </tr>
                    <?php for($i = 0; $i < 4; $i ++): ?>
                      <tr>
                      <?php foreach($items as $item): ?>
                          <td>
                          <div>
                            <img src=<?=$item->image_src?>>
                            <p><?=$item->name?></p>
                            <p><?=$item->value?></p>
                          </div>
                        </td>
                      <?php endforeach; ?>
                      </tr>
                    <?php endfor; ?> 
                </table>
            </div>
        </main>
        <script language="JavaScript" src="View/pages/shared/js/navbar.js"></script>
        <script language="JavaScript" src="View/pages/shared/js/game.js"></script>
        <script language="JavaScript">
            let jogo = new game(clickValue=<?= $model->clickValue ?> , usermoney=<?= $model->money ?>, multiplier=<?= $model->multiplier ?>);
            jogo.UpdateUserMoney();
        </script>
    </body>
</html>