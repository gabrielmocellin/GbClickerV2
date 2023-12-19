<?php
    /** @var GbClicker\Model\UserModel $model */
?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel='stylesheet' href='css/site.css'>
    <link rel='stylesheet' href='css/profile.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Perfil | <?= $profile->getNickname(); ?></title>
</head>
<body>
    <?php require_once "util/header.php"; ?>
    <main>
        <?php require "util/navbar.php"; ?>
        <div id='profile'>
            <div class='top'>
                <img src='<?= $profile->getImageSrc(); ?>'>
                <section>
                    <h1 class='profile-nickname'>@<?= $profile->getNickname(); ?></h1>
                    <h1 class='profile-rank'>TOP #<?= $profile->getRank(); ?> Dinheiro</h1>
                </section>
            </div>
            <div class='bottom'>
                <section>
                    <h1><?= $profile->getLevel(); ?></h1>
                    <p>Nível</p>
                </section>
                <section>
                    <h1><?= $profile->getClickValue(); ?></h1>
                    <p>Valor P/ Clique</p>
                </section>
                <section>
                    <h1><?= $profile->getMultiplier(); ?></h1>
                    <p>Multiplicador</p>
                </section>
                <section>
                    <h1><?= $profile->getMoney(); ?></h1>
                    <p>Dinheiro</p>
                </section>
                <section>
                    <h1><?= $profile->getMinions(); ?></h1>
                    <p>Minions</p>
                </section>
            </div>
        </div>
    </main>
    <?php require 'util/importJScreateGame.php'; ?>
    <script lang='JavaScript' src='js/util/formatadorNums.js'></script>
    <script>
        window.onload = function() {
            formatarNumerosNasDivs('.bottom section h1', 1);
        };
    </script>
</body>
</html>