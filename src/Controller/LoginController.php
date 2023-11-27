<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;

class LoginController
{
    public static function index()
    {
        require_once __DIR__ . '/../../View/login/login.html';
    }

    public static function login()
    {
        session_start();
        if (session_status() != 2) {
            header("location: /login?erro=criar_sessao");
        }
        if (isset($_SESSION['email'])) { // Caso o usuário já esteja logado no sistema
            $model = new UserModel();
            $model->setEmail($_SESSION['email']);
            $model->getByEmail();
        } elseif (isset($_POST['email-input']) && isset($_POST['password-input'])) {
            $model = new UserModel();
            $model->setEmail($_POST['email-input']);
            $model->setPassword($_POST['password-input']);
            if (!$model->getByEmailAndPassword()) {
                header("location: /login?erro=senha_email_invalidos");
                exit();
            };
            $_SESSION['email'] = $model->getEmail();
            $_POST = array();
        } else {
            header("location: /login?erroUm=SemEmailSession&erroDois=PostsNaoCriados");
        }
        require 'View/home/home.php';
    }

    public static function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location: /?sessao=0");
    }
}
