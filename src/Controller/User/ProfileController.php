<?php

namespace GbClicker\Controller\User;
use GbClicker\Model\ProfileModel;
use GbClicker\Controller\Auth\LoginController;

class ProfileController
{

    private LoginController $loginController;

    public function __construct(LoginController $loginController)
    {
        $this->loginController = $loginController;
    }
    public function index()
    {
        $model = $this->loginController->login();
        
        if ($model == null) {
            header("location: /login?aviso=1", true);
            exit;
        }
        
        $profile = $this->verificarTipoPerfil($model);
        $linksCss = [
            'css/profile.css'
        ];
        $srcJs = [
            'js/Profile/profile.js'
        ];
        $titulo = 'Perfil | ' . $profile->getNickname();
        $conteudoMain = '../View/profile/profile.php';
        require_once '../src/Components/template.php';
    }

    public function getProfileInfoById(int $id)
    {
        $profileModel = new ProfileModel($id);
        return $profileModel;
    }

    public function verificarTipoPerfil($model)
    {
        if (isset($_GET['id'])) {
            $profile = $this->getProfileInfoById($_GET['id']);
            if ($profile->getNickname() == NULL) { // Caso o usuário não exista!
                header("location: \\profile");
            }
        } else {
            $profile = $this->getProfileInfoById($model->getId());
        }
        return $profile;
    }
}
