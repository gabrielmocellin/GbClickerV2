<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;

class SaveRegisterController
{
    public static function index()
    {
        if (
            SaveRegisterController::validarEmailInput($_POST['email-input']) &&
            SaveRegisterController::validarSenhaInput($_POST['password-input']) &&
            SaveRegisterController::validarNicknameInput($_POST['nickname-input']) &&
            SaveRegisterController::validarImagemInput($_FILES['image_src'])
        ) {
            $path = SaveRegisterController::salvarImagemLocalmente($_FILES['image_src']);
            $model = new UserModel();
            $model->construtor($_POST['email-input'], $_POST['password-input'], $_POST['nickname-input'], $path);
            try{
                if ($model->save()) {
                    header("location: /login?sucesso=1");
                    return;
                };
            } catch(\Exception $exception){
                if ($exception->getCode() == 23000) {
                    header("location: /register?emailDuplicado=1");
                };
            }
        }
    }

    public static function validarEmailInput($emailValue)
    {
        $result = filter_var($emailValue, FILTER_VALIDATE_EMAIL);
        if ($result === false) {
            header("location: /register?sucesso=001");
            return;
        }
        return true;
    }

    public static function validarSenhaInput($senhaValue)
    {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,16}$/";
        $result = preg_match($pattern, $senhaValue);
        if ($result === false) {
            header("location: /register?sucesso=002");
            return;
        }
        return $result;
    }

    public static function validarNicknameInput($nicknameValue)
    {
        $pattern = "/^(?=.*[A-z])[A-z0-9_-]{2,16}$/";
        $result = preg_match($pattern, $nicknameValue);
        if ($result === false) {
            header("location: /register?sucesso=003");
            return;
        }
        return $result;
    }

    public static function validarImagemInput($imagem)
    {
        $tiposPermitidos = ["image/jpeg", "image/jpg", "image/png"];
        
        if (in_array($imagem['type'], $tiposPermitidos)) {
            return true;
        }
        $imagem['error'] = UPLOAD_ERR_NO_FILE;
        SaveRegisterController::validarErrosNoUploadDaImagem($imagem);
        return false;
    }

    public static function validarErrosNoUploadDaImagem($imagem)
    {
        switch ($imagem['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                header("location: /register?erroImagem=4"); // Nenhum arquivo encontrado
                break;
            case UPLOAD_ERR_FORM_SIZE: // Maior que o limite do form html
                header("location: /register?erroImagem=2");
                break;
            case UPLOAD_ERR_INI_SIZE: // Maior que o limite do php.ini
                header("location: /register?erroImagem=1");
                break;
            default:
                echo "Erro desconhecido.";
                break;
        }
    }

    public static function salvarImagemLocalmente($imagem)
    {
        $pathRelativo = "img\\uploads\\profile\\";
        $pathCompleto = __DIR__ . "\\..\\..\\public\\$pathRelativo" . basename($imagem['name']);
        if (!move_uploaded_file($imagem['tmp_name'], $pathCompleto)) {
            header("location: /register?erroImagem=7");
            return;
        };
        return $pathRelativo . basename($imagem['name']);
    }
}
