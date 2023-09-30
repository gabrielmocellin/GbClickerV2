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
        <div id="clicker-parent-div">
            <div id="left-clicker-content-side">
                <div class="buff-countdown-div">
                    <img src="View/pages/shared/icons/account.png">
                    <p>Bonus</p>
                    <p>59:12</p>
                </div>
                <div class="buff-countdown-div">
                    <img src="View/pages/shared/icons/account.png">
                    <p>Moedas</p>
                    <p>59:12</p>
                </div>
            </div>
            <div id="middle-clicker-content-side">
                <ul id="clicker-infos">
                    <li id='user_mult_li'></li>
                    <li id='money_sec_li'></li>
                    <li>Minions: 0</li>
                </ul>
                <div id="clicker-img-div" class="image-clicker-div">
                    <img draggable="false" src="View/pages/home/img/gb.png" id="clicker-img" onclick="jogo.ClickOnClicker(event)">
                </div>
                <div class="level-progress-div">
                    <p id="level-info-p">Level: 100</p>
                    <div id="level-progress-bar"></div>
                </div>
            </div>
            <div id="right-clicker-content-side">

            </div>
        </div>
    </main>

    <form id="form-user-save-data" action='' style='display:none;'>
        <input id='clickValue-input' name='clickValue-input' type='text'>
        <input id='money-input' name='money-input' type='text'>
        <input id='multiplier-input' name='multiplier-input' type='text'>
        <input id='level-input' name='level-input' type='text'>
        <input id='xp-points-input' name='xp-points-input' type='text'>
        <input id='max-to-up-input' name='max-to-up-input' type='text'>
    </form>

    <script language="JavaScript" src="View/pages/shared/js/navbar.js"></script>
    <script language="JavaScript" src="View/pages/shared/js/game.js"></script>
    <script language="JavaScript">
        var jogo = new game(
            clickValue = <?=$model->clickValue;?>,
            userMoney  = <?=$model->money;?>,
            multiplier = <?=$model->multiplier;?>,
            level      = <?=$model->level_data->level;?>,
            xp_points  = <?=$model->level_data->xp_points;?>,
            max_to_up  = <?=$model->level_data->max_to_up;?>
        );
    </script>
    <script language="JavaScript" src="View/pages/shared/js/xhr.js"></script>
</body>
</html>