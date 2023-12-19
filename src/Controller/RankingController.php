<?php

namespace GbClicker\Controller;

use GbClicker\Controller\LoginController;
use GbClicker\Model\RankModel;

class RankingController
{
    public static function index()
    {
        $model = LoginController::login();
        if ($model !== null) {
            include_once __DIR__ . "\\..\\..\\View\\ranking\\ranking.php";
            return;
        }
        header("location: \\login?aviso=1");
        return;
    }

    public static function showUsers()
    {
        $rankModel = new RankModel();
        $usuarios = $rankModel->getArrayInfoRankedPlayers();
        foreach ($usuarios as $usuario) {
            echo  "
            <div class='linha'>
                <p class='rank'>" . $usuario->getRank() . "</p>
                <img src='" . $usuario->getImageSrc() . "'>
                <p>" . $usuario->getMoney() . "</p>
                <p>" . $usuario->getClickValue() . "</p>
                <p>" . $usuario->getMultiplier() . "</p>
                <p>" . $usuario->getMinions() . "</p>
            </div>
            ";
        }
    }
}