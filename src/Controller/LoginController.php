<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;

class LoginController
{
    public static function index()
    {
        session_start();
        if (session_status() == 2) {
            if (
                isset($_SESSION['email']) &&
                session_status() == 2
            ) {
                header("location: /home");
            }
        }
        include_once __DIR__ . '/../../View/login/login.php';
    }

    public static function login()
    {
        session_start();
        if (session_status() != 2) {
            header("location: /login?erro=3");
        }
        if (isset($_SESSION['email'])) { // Caso o usuário já esteja logado no sistema
            $model = new UserModel();
            $model->setEmail($_SESSION['email']);
            $model->getByEmail();
            return $model;
        } elseif (isset($_POST['email-input']) && isset($_POST['password-input'])) {
            $model = new UserModel();
            $model->setEmail($_POST['email-input']);
            $model->setPassword($_POST['password-input']);
            if (!$model->getByEmailAndPassword()) {
                header("location: /login?erro=1");
                return;
            };
            $_SESSION['email'] = $model->getEmail();
            $_POST = array();
            return $model;
        }
    }

    public static function verificarAvisos()
    {
        if (isset($_GET['aviso'])) {
            $codigoDoAviso = $_GET['aviso'];
            echo "<script>login.verificarAvisos('$codigoDoAviso')</script>";
        }
    }
}
