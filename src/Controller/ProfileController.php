<?php

namespace GbClicker\Controller;
use GbClicker\Model\ProfileModel;

class ProfileController
{
    public static function index()
    {
        $model = LoginController::login();
        if ($model != null) {
            if (isset($_GET['id'])) {
                $profile = ProfileController::getProfileInfoById($_GET['id']);
            } else {
                $profile = ProfileController::getProfileInfoById($model->getId());
            }
            include_once __DIR__ . '/../../View/profile/profile.php';
        } else {
            header("location: \\login?aviso=1");
        }
    }

    public static function getProfileInfoById(int $id)
    {
        $profileModel = new ProfileModel($id);
        return $profileModel;
    }
}
