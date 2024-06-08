<?php

namespace GbClicker\Controller;

use GbClicker\Controller\LoginController;
use GbClicker\Model\RankModel;

class RankingController
{
    public static function index()
    {
        $model = LoginController::login();
        
        if ($model == null) {
            header("location: /login?aviso=1", true);
            exit;
        }

        $titulo = 'Ranking';
        $linksCss = [
            'css/adminpages.css',
            'css/ranking.css'
        ];
        $srcJs = [
            'js/Ranking/ranking.js'
        ];
        $conteudoMain = '..\\View\\ranking\\ranking.php';
        require_once '../src/Components/template.php';
    }

    public static function showUsers()
    {
        $rankModel = new RankModel();
        $class = "rank first_rank";
        $usuarios = $rankModel->getArrayInfoRankedPlayers();
        foreach ($usuarios as $usuario) {
            echo  "
            <a class='linha' href='/profile?id=".$usuario->getId()."'>
                <p class='$class'>" . $usuario->getRank() . "</p>
                <img src='" . $usuario->getImageSrc() . "'>
                <p>" . $usuario->getMoney() . "</p>
                <p>" . $usuario->getClickValue() . "</p>
                <p>" . $usuario->getMultiplier() . "</p>
                <p>" . $usuario->getMinions() . "</p>
            </a>
            ";
            $class = "rank";
        }
    }
}