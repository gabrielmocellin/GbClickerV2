<?php
    /** @var GbClicker\Model\UserModel $model */

use GbClicker\Controller\AccountsController;

?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel='stylesheet' href='../css/site.css'>
    <link rel="stylesheet" href="../css/adminpages.css">
    <link rel="stylesheet" href="../css/accounts.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Contas</title>
</head>
<body>
    <?php require_once "util/header.php"; ?>
    <main>
        <?php require_once "util/navbar.php"; ?>
        <div id='admin'>
            <div class='top'>
                <h1 class='boas_vindas'>Gerenciar Contas</h1>
            </div>
            <div class='header'>
                <p>ID</p>
                <p>Email</p>
                <p>Nickname</p>
                <p>Foto</p>
                <p>R$</p>
                <p>Valor p/Clique</p>
                <p>Multiplicador</p>
                <p>Minions</p>
                <p>Ações</p>
            </div>
            <?php AccountsController::showUsers(); ?>
            <section class='seletor-paginas'>
                <a href='/admin/accounts?page=1'>1</a>
                <a href='/admin/accounts?page=2'>2</a>
                <a href='/admin/accounts?page=3'>3</a>
                <a href='/admin/accounts?page=4'>4</a>
                <a href='/admin/accounts?page=5'>5</a>
                <a href='/admin/accounts?page=6'>6</a>
                <a href='/admin/accounts?page=7'>7</a>
                <a href='/admin/accounts?page=8'>8</a>
                <a href='/admin/accounts?page=9'>9</a>
                <a>...</a>
            </section>
        </div>
        
    </main>
    <?php require 'util/importJsScripts.php'; ?>
    <script lang='JavaScript' src='<?= $GLOBALS['prefix'] ?>js/util/formatadorNums.js'></script>
    <script lang='JavaScript' src='<?= $GLOBALS['prefix'] ?>js/Accounts/accounts.js'></script>
    <script>
        window.onload = function() {
            formatarNumerosNasDivs('.linha p', 1);
        };
    </script>
</body>
</html>