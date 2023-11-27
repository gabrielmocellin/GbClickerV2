<?php /** @var GbClicker\Model\UserModel $model */ ?>  
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='css/site.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Gb Clicker II</title>
</head>
<body>
    <?php require_once "util/header.php"; ?>
    <main>
        <?php require "util/navbar.php"; ?>
        <div id="clicker-parent-div">
            <div id="left-clicker-content-side">
                <div class="buff-countdown-div">
                    <img src="img/logo.png">
                    <p>Bonus</p>
                    <p>59:12</p>
                </div>
                <div class="buff-countdown-div">
                    <img src="img/logo.png">
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
                    <img draggable="false" src="img/logo.png" id="clicker-img" onclick="jogo.ClickOnClicker(event)">
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
    <?php require 'util/importJScreateGame.php'; ?>
</body>
</html>