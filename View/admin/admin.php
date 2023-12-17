<?php
    /** @var GbClicker\Model\UserModel $model */
?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel='stylesheet' href='css/site.css'>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Admin</title>
</head>
<body>
    <?php require_once "util/header.php"; ?>
    <main>
        <?php require_once "util/navbar.php"; ?>
        <div id='admin'>
            <div class='top'>
                <h1 class='boas_vindas'>Bem-vindo, <?= $model->getNickname(); ?>!</h1>
            </div>
            <div class='bottom'>
                <a href='#' class='disabled'>
                    <img src='img/icons/account.png'>
                    <h1>Contas</h1>
                </a>
                <a href='/items'>
                    <img src='img/icons/add_item.png'>
                    <h1>Itens</h1>
                </a>
                <a href='#' class='disabled'>
                    <img src='img/icons/ticket.png'>
                    <h1>Códigos</h1>
                </a>
                <a href='#' class='disabled'>
                    <img src='img/icons/machines.png'>
                    <h1>Máquinas</h1>
                </a>
                <a href='#' class='disabled'>
                    <img src='img/icons/maintenance.png'>
                    <h1>Minions</h1>
                </a>
                <a href='#' class='disabled'>
                    <img src='img/icons/maintenance.png'>
                    <h1>Minions</h1>
                </a>
            </div>
        </div>
    </main>
    <?php require 'util/importJScreateGame.php'; ?>
</body>
</html>