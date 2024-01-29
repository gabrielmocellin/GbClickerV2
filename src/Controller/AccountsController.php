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
        if (!isset($_GET['page'])) {
            $contas = $usermodel->getFirstTenAccoutsByPage(1);
        } else {
            $contas = $usermodel->getFirstTenAccoutsByPage($_GET['page']);
        }

        foreach ($contas as $conta) {
            echo AccountsController::montarLinha($conta);
        }

    }

    public static function montarLinha($conta)
    {
        $informacoes_e_tipo_input_array = array(
            [$conta->getNickname(), "text"],
            [$conta->getImageSrc(), "image"],
            [$conta->getMoney(), "number"],
            [$conta->getClickValue(), "number"],
            [$conta->getMultiplier(), "number"],
            [$conta->getMinions(), "number"]
        );

        $comecoLinha = "
        <form id='id_" . $conta->getId() . "' class='linha' method='POST' action='#'>
            <p class='p_user_info'>" . $conta->getId() . "</p>
            <p class='p_user_info'>" . $conta->getEmail() . "</p>
        ";

        $meioLinha = "";
        foreach($informacoes_e_tipo_input_array as $infos) {
            if ($infos[1] === "image") {
                $meioLinha .= "
                    <img src='../" . $infos[0] . "'>
                ";
                continue;
            }
            $meioLinha .= "
                <p class='p_user_info info_editaveis'> " . $infos[0] . "</p>
                <input style='display:none' class='inputs_edicao' type=" . $infos[1] . " value='" . $infos[0] . "'>
            ";
        }

        $fimLinha = "
            <a onclick='edicao(" . $conta->getId() . ")' class='botao-acoes blue'>Editar</a>
            <a id='botao-remover' class='botao-acoes red'>Remover</a>
            <a id='botao-salvar' style='display:none' href='#' class='botao-acoes green'>Salvar</a>
        </form>
    ";

        return $comecoLinha . $meioLinha . $fimLinha;
    } 
}
