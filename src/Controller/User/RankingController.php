<?php

namespace GbClicker\Controller\User;

use GbClicker\Controller\Auth\LoginController;
use GbClicker\Service\ProfileService;

class RankingController
{

    private LoginController $loginController;
    private ProfileService $profileService;

    public function __construct(LoginController $loginController, ProfileService $profileService)
    {
        $this->loginController = $loginController;
        $this->profileService = $profileService;
    }
    public function index()
    {
        $model = $this->loginController->login();
        
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

    public function showUsers()
    {
        $class = "rank first_rank";
        $usuarios = $this->profileService->getRankedPlayers();
        foreach ($usuarios as $usuario) {
            echo  "
            <a class='linha' href='/profile?id=".$usuario->getId()."'>
                <p class='$class'>" . $usuario->getRank() . "</p>
                <div class='jogador'>
                    <img src='" . $usuario->getImageSrc() . "'>
                    <p class='jogador-nome'>" . $usuario->getNickname() . "</p>
                </div>
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
