<?php

namespace GbClicker\Controller;

use GbClicker\DAO\UserDAO;

use GbClicker\Model\UserModel;

class AccountsController
{
    public static function index()
    {
        $model = AdminPageController::verifyAdminAccount();
        $contas = [];
        include __DIR__ . "\\..\\..\\View\\admin\\accounts.php";
    }

    public static function showUsers()
    {
        $usermodel = new UserModel();
        $contas = $usermodel->getFirstTenAccoutsByPage(1);
        foreach ($contas as $conta) {
            echo  "
            <div class='linha'>
                <p>" . $conta->getId() . "</p>
                <p>" . $conta->getEmail() . "</p>
                <p>" . $conta->getNickname() . "</p>
                <img src='../" . $conta->getImageSrc() . "'>
                <p>" . $conta->getMoney() . "</p>
                <p>" . $conta->getClickValue() . "</p>
                <p>" . $conta->getMultiplier() . "</p>
                <p>" . $conta->getMinions() . "</p>
                <a class='botao-acoes blue'>Editar</a>
                <a class='botao-acoes red'>Remover</a>
            </div>
            ";
        }
    }
}
