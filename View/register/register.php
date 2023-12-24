<?php

    use GbClicker\Controller\RegisterController;

?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel='stylesheet' href='css/notificacao.css'>
    <link rel="stylesheet" href="css/siteTmp.css">
    <link rel="stylesheet" href="css/register.css">
    <title>Registro</title>
</head>
<body>
    <?php require_once "util/notificacao.php"; ?>
    <header>
        <a class="pointer header-a" id="header-logo" href="/">GbClicker</a>
        <a class="pointer header-a" id="login-button" href="/login">Login</a>
    </header>
    <main> 
        <form id="register-form" method='POST' enctype='multipart/form-data' action="/register/save">

            <div id="left-side">
                <label id="image-input-label" for="image-input">Selecionar Foto</label>
                <input style="display:none;" id="image-input" name="image_src" type="file" accept="image/png, image/jpeg, image/jpg">

                <img id="image-preview" src="img/icons/account.png">
                <div id="have-account-div">
                    <p id="have-account-question">Já possui uma conta?</p>
                    <p id="login-here-button">Entre aqui</p>
                </div>
            </div>

            <div id="right-side">
                <div id="inputs-div">
                    <label for="email">Email:</label>
                    <input name="email-input" id="email" type="email" maxlength="120" required>

                    <label for="username">Usuário:</label>
                    <input name="nickname-input" id="username" type="text" maxlength="120" required>

                    <label for="password">Senha:</label>
                    <input name="password-input" id="password" type="password" maxlength="30" required>

                    <label for="confirm-password">Confirmar senha:</label>
                    <input id="confirm-password" type="password" maxlength="30" required>
                </div>
                
                <div id="submit-button-div">
                    <button id="submit-button" type="submit">Registrar</button>
                </div>
            </div>
        </form>
    </main>
    <script lang="JavaScript" src="js/Notificacao.js"></script> 
    <script lang="JavaScript" src="js/Registro/Formulario.js"></script> 
    <script lang="JavaScript" src="js/Registro/Registro.js"></script>
    <script>let registro = new Registro();</script>
    <?php RegisterController::verificarAvisos(); ?>
</body>
</html>