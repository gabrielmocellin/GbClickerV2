<?php

namespace GbClicker\Controller;

use GbClicker\Model\{UserModel, RegisterModel, UserCredentialsModel, ImageModel};

class SaveRegisterController
{
    public static function index()
    {
        if (self::validarInputs()) {
            $imageModel = new ImageModel($_FILES);
            $userCredentials = new UserCredentialsModel($_POST['email-input'], $_POST['password-input']);
            $registerModel = new RegisterModel($userCredentials, $_POST['nickname-input'], $imageModel->path);
            
            try {
                $isImageSaved = $imageModel->isImageSaved;
                if ($isImageSaved && $registerModel->save()) {
                    header("location: /login?aviso=0", true);
                    return;
                } else {
                    echo "deu pau";
                }
            } catch (\Exception $exception) {
                if ($exception->getCode() == 23000) {
                    if (str_contains($exception->getMessage(), "usuario.PRIMARY")) {
                        header("location: /register?aviso=8", true);
                    } else {
                        header("location: /register?aviso=9", true);
                    }
                    exit;
                };
            }
        } else {
            header('location: /register?aviso=0', true);
        }
    }

    public static function areRequiredFieldsFilled()
    {
        $requiredFieldsFilled = isset($_POST['email-input']) && 
        isset($_POST['password-input']) && 
        isset($_POST['nickname-input']);

        return $requiredFieldsFilled;
    }

    public static function validarInputs()
    {
        $areFieldsValid = self::areRequiredFieldsFilled() &&
        self::validarEmailInput($_POST['email-input']) &&
        self::validarSenhaInput($_POST['password-input']) &&
        self::validarNicknameInput($_POST['nickname-input']);

        if (!$areFieldsValid) {
            return false;
        }

        return true;
    }

    public static function validarEmailInput($emailValue)
    {
        $result = filter_var($emailValue, FILTER_VALIDATE_EMAIL);
        if ($result === false) {
            header("location: /register?aviso=1");
            return;
        }
        return true;
    }

    public static function validarSenhaInput($senhaValue)
    {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,16}$/";
        $result = preg_match($pattern, $senhaValue);
        if ($result === false) {
            header("location: /register?aviso=2");
            return;
        }
        return $result;
    }

    public static function validarNicknameInput($nicknameValue)
    {
        $pattern = "/^(?=.*[A-z])[A-z0-9_-]{2,16}$/";
        $result = preg_match($pattern, $nicknameValue);
        if ($result === false) {
            header("location: /register?aviso=3");
            return;
        }
        return $result;
    }
}

