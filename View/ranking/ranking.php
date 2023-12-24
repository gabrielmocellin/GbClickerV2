<?php
    /** @var GbClicker\Model\UserModel $model */

use GbClicker\Controller\RankingController;

?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel='stylesheet' href='css/site.css'>
    <link rel="stylesheet" href="css/adminpages.css">
    <link rel="stylesheet" href="css/ranking.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Ranking</title>
</head>
<body>
    <?php require_once "util/header.php"; ?>
    <main>
        <?php require_once "util/navbar.php"; ?>
        <div id='admin'>
            <div class='top'>
                <h1 class='boas_vindas'>TOP 10 Magnatas</h1>
            </div>
            <div class='header'>
                <p>Rank</p>
                <p>Foto</p>
                <p>R$</p>
                <p>V.Clique</p>
                <p>Mult</p>
                <p>Minions</p>
            </div>
            <?php RankingController::showUsers(); ?>
        </div>
    </main>
    <?php require 'util/importJsScripts.php'; ?>
    <script lang='JavaScript' src='js/util/formatadorNums.js'></script>
    <script>
        window.onload = function() {
            formatarNumerosNasDivs('.linha p', 1);
        };
    </script>
</body>
</html>