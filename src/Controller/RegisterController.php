<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;

class RegisterController
{
    public static function index()
    {
        include "View/register/register.html";
    }

    public static function register()
    {
        $path = 'View/uploads/profile/' . basename($_FILES['image_src']['name']);
        move_uploaded_file($_FILES['image_src']['tmp_name'], $path);

        $model = new UserModel();
        if (
            RegisterController::validarEmailInput($_POST['email-input']) && 
            RegisterController::validarSenhaInput($_POST['password-input']) &&
            RegisterController::validarNicknameInput($_POST['nickname-input'])
            ) {
                $model->construtor($_POST['email-input'], $_POST['password-input'], $_POST['nickname-input'], $path);
                if ($model->save()) {
                    header("location: /login?sucesso=1");
                    return;
                };
        }
        header("location: /register?sucesso=0");
    }

    public static function validarEmailInput($emailValue)
    {
        $result = filter_var($emailValue, FILTER_VALIDATE_EMAIL);
        if (!$result) {
            $result;
        }
        return true;
    }

    public static function validarSenhaInput($senhaValue)
    {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,16}$/";
        $result = preg_match($pattern, $senhaValue);
        return $result;
    }

    public static function validarNicknameInput($nicknameValue)
    {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,16}$/";
        $result = preg_match($pattern, $nicknameValue);
        return $result;
    }
}
