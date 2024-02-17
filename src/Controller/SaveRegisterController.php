<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;

class SaveRegisterController
{
    public static function index()
    {
        if (SaveRegisterController::validarInputs()) {
            $path = self::retornarPathImagem();
            $model = new UserModel();
            $model->construtor(
                $_POST['email-input'],
                $_POST['password-input'],
                $_POST['nickname-input'],
                $path
            );
            
            try {
                if ($model->save()) {
                    self::salvarImagemLocalmente($model->getImageSrc());
                    header("location: /login?aviso=0");
                    return;
                };
            } catch (\Exception $exception) {
                if ($exception->getCode() == 23000) {
                    if (str_contains($exception->getMessage(), "usuario.PRIMARY")) {
                        header("location: /register?aviso=8");
                    } else {
                        header("location: /register?aviso=9");
                    }
                };
            }
        } else {
            header('location: /register?aviso=0');
        }
    }

    public static function validarInputs()
    {
        if (
            isset($_POST['email-input']) &&
            isset($_POST['password-input']) &&
            isset($_POST['nickname-input']) &&
            isset($_FILES['image_src'])
        ) {
            if (
                SaveRegisterController::validarEmailInput($_POST['email-input']) &&
                SaveRegisterController::validarSenhaInput($_POST['password-input']) &&
                SaveRegisterController::validarNicknameInput($_POST['nickname-input']) &&
                SaveRegisterController::validarImagemInput($_FILES['image_src'])
            ) {
                return true;
            }
        }
        return false;
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
                header("location: /register?aviso=4"); // Nenhum arquivo encontrado
                exit;
            case UPLOAD_ERR_FORM_SIZE: // Maior que o limite do form html
                header("location: /register?aviso=5");
                exit;
            case UPLOAD_ERR_INI_SIZE: // Maior que o limite do php.ini
                header("location: /register?aviso=6");
                exit;
            default:
                echo "Erro desconhecido.";
                break;
        }
    }

    public static function salvarImagemLocalmente($pathCompleto)
    {
        $nomeTemporarioImagem = $_FILES['image_src']['tmp_name'];
        $isImageSaved = move_uploaded_file($nomeTemporarioImagem, $pathCompleto);

        if (!$isImageSaved) {
            header("location: /register?aviso=7");
            exit();
        };

        return true;
    }

    public static function retornarPathImagem()
    {
        $imagem = $_FILES['image_src'];
        $pathRelativo = "img\\uploads\\profile\\";
        $nomeImagem = uniqid() . basename($imagem['name']);
        $pathCompleto = __DIR__ . "\\..\\..\\public\\$pathRelativo" . $nomeImagem;

        return $pathRelativo . $nomeImagem;
    }

}

