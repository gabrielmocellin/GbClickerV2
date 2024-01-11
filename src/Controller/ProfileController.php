<?php

namespace GbClicker\Controller;
use GbClicker\Model\ProfileModel;

class ProfileController
{
    public static function index()
    {
        $model = LoginController::login();
        
        if (isset($_GET['id'])) {
            $profile = ProfileController::getProfileInfoById($_GET['id']);
            if ($profile->getNickname() == NULL) { // Caso o usuário não exista!
                header("location: \\profile");
            }
        } else {
            $profile = ProfileController::getProfileInfoById($model->getId());
        }
        include_once __DIR__ . '/../../View/profile/profile.php';
    }

    public static function getProfileInfoById(int $id)
    {
        $profileModel = new ProfileModel($id);
        return $profileModel;
    }
}
