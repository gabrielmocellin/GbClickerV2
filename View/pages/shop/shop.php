<?php
    /** @var UserModel $model */
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
                    <tr class='tableHead'>
                      <th>Loja</th>
                    </tr>
                    <tr>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP</p>
                          <p>R$ 10,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP +</p>
                          <p>R$ 15,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP Ruby</p>
                          <p>R$ 30,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP Safira</p>
                          <p>R$ 50,00</p>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP</p>
                          <p>R$ 10,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP +</p>
                          <p>R$ 15,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP Ruby</p>
                          <p>R$ 30,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP Safira</p>
                          <p>R$ 50,00</p>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP</p>
                          <p>R$ 10,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP +</p>
                          <p>R$ 15,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP Ruby</p>
                          <p>R$ 30,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP Safira</p>
                          <p>R$ 50,00</p>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP</p>
                          <p>R$ 10,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP +</p>
                          <p>R$ 15,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP Ruby</p>
                          <p>R$ 30,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP Safira</p>
                          <p>R$ 50,00</p>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP</p>
                          <p>R$ 10,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP +</p>
                          <p>R$ 15,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP Ruby</p>
                          <p>R$ 30,00</p>
                        </div>
                      </td>
                      <td>
                        <div>
                          <img src="View/pages/shared/icons/account.png">
                          <p>VIP Safira</p>
                          <p>R$ 50,00</p>
                        </div>
                      </td>
                    </tr>

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