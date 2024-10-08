<?php

    use GbClicker\Controller\LoginController;

?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel='stylesheet' href='css/notificacao.css'>
    <link rel="stylesheet" href="css/siteTmp.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <?php require_once "util/notificacao.php"; ?>
    <header>
        <a class="pointer header-a" id="header-logo" href="/">GbClicker</a>
        <a class="pointer header-a" id="register-button" href="/register">Registrar</a>
    </header>
    <main> 

        <form id="login-form" method='POST' action="/home">
            <div id="img-logo-div">
                <img src="img/games_logo.png">
            </div>
            <div id="inputs-div">

                <label for="email">Email:</label>
                <input name="email-input" id="email" type="email" maxlength="120" required>

                <label for="password">Senha:</label>
                <input name="password-input" id="password" type="password" maxlength="30" required>
                
                <div id="checkbox-div">
                    <input name="cookie-checkbox" class="checkbox-input" type="checkbox"> <label for="cookie-checkbox">Lembrar conta?</label>
                </div>

            </div>
            
            <div id="submit-button-div">
                <button id="login-button" type="submit">Login</button>
            </div>
        </form>

    </main>
    <script lang="JavaScript" src="js/Notificacao.js"></script> 
    <script lang="JavaScript" src="js/Login/Formulario.js"></script> 
    <script lang="JavaScript" src="js/Login/Login.js"></script>
    <script>var login = new Login();</script>
    <?php LoginController::dispararAvisos(); ?>
</body>
</html>