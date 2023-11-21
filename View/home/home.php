<?php /** @var UserModel $model */ ?>  
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
        <div id="clicker-parent-div">
            <div id="left-clicker-content-side">
                <div class="buff-countdown-div">
                    <img src="View/shared/icons/account.png">
                    <p>Bonus</p>
                    <p>59:12</p>
                </div>
                <div class="buff-countdown-div">
                    <img src="View/shared/icons/account.png">
                    <p>Moedas</p>
                    <p>59:12</p>
                </div>
            </div>
            <div id="middle-clicker-content-side">
                <ul id="clicker-infos">
                    <li id='user_mult_li'></li>
                    <li id='money_sec_li'></li>
                    <li id='minions_sec_li'></li>
                </ul>
                <div id="clicker-img-div" class="image-clicker-div">
                    <img draggable="false" src="View/home/img/gb.png" id="clicker-img" onclick="jogo.ClickOnClicker(event)">
                </div>
                <div class="level-progress-div">
                    <p id="level-info-p"></p>
                    <div id="level-progress-bar"></div>
                </div>
            </div>
            <div id="right-clicker-content-side">

            </div>
        </div>
    </main>

    <form id="form-user-save-data" action='' style='display:none;'>
        <input id='clickValue-input' name='clickValue-input' type='text'>
        <input id='money-input'      name='money-input' type='text'>
        <input id='multiplier-input' name='multiplier-input' type='text'>
        <input id='minions-input'    name='minions-input' type='text'>
        <input id='level-input'      name='level-input' type='text'>
        <input id='xp-points-input'  name='xp-points-input' type='text'>
        <input id='max-to-up-input'  name='max-to-up-input' type='text'>
    </form>

    <script language="JavaScript" src="View/shared/js/navbar.js"></script>
    <script language="JavaScript" src="View/shared/js/game.js"></script>
    <script language="JavaScript">
        var jogo = new game(
            clickValue = <?= $model->getClickValue(); ?>,
            userMoney  = <?= $model->getMoney(); ?>,
            multiplier = <?= $model->getMultiplier(); ?>,
            minions    = <?= $model->getMinions(); ?>,
            level      = <?= $model->getLevelData()->level; ?>,
            xp_points  = <?= $model->getLevelData()->xp_points; ?>,
            max_to_up  = <?= $model->getLevelData()->max_to_up; ?>
        );
    </script>
    <script language="JavaScript" src="View/shared/js/xhr.js"></script>
</body>
</html>