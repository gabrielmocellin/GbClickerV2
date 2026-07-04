<?php

namespace GbClicker\Controller\Auth\Actions;

use GbClicker\Model\{UserModel, RegisterModel, UserCredentialsModel, ImageModel};
use GbClicker\Http\Request;

class SaveRegisterController
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        if ($this->validarInputs()) {
            // TODO: abstract $_FILES into Request
            $imageModel = new ImageModel($_FILES);
            $userCredentials = new UserCredentialsModel($this->request->post('email-input'), $this->request->post('password-input'));
            $registerModel = new RegisterModel($userCredentials, $this->request->post('nickname-input'), $imageModel->path);
            
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

    public function areRequiredFieldsFilled()
    {
        $requiredFieldsFilled = $this->request->hasPost('email-input') && 
        $this->request->hasPost('password-input') && 
        $this->request->hasPost('nickname-input');

        return $requiredFieldsFilled;
    }

    public function validarInputs()
    {
        $areFieldsValid = $this->areRequiredFieldsFilled() &&
        $this->validarEmailInput($this->request->post('email-input')) &&
        $this->validarSenhaInput($this->request->post('password-input')) &&
        $this->validarNicknameInput($this->request->post('nickname-input'));

        if (!$areFieldsValid) {
            return false;
        }

        return true;
    }

    public function validarEmailInput($emailValue)
    {
        $result = filter_var($emailValue, FILTER_VALIDATE_EMAIL);
        if ($result === false) {
            header("location: /register?aviso=1");
            return;
        }
        return true;
    }

    public function validarSenhaInput($senhaValue)
    {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,16}$/";
        $result = preg_match($pattern, $senhaValue);
        if ($result === false) {
            header("location: /register?aviso=2");
            return;
        }
        return $result;
    }

    public function validarNicknameInput($nicknameValue)
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

