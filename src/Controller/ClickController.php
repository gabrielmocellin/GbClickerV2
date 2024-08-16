<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;
use GbClicker\Conexao\Conexao;
use GbClicker\Controller\LoginController;

class ClickController
{
    const DINHEIRO_SALVO = 200;
    const ERRO_AO_INICIAR_SESSAO = 201;
    const ERRO_AO_SALVAR_DINHEIRO = 202;

    public static function index()
    {
        # Aqui nós primeiro devemos verificar se o usuário está logado (possui uma sessão válida).
        # Caso tenha uma sessão inválida, será retornado um código de erro para inicializar uma notificação ao usuário.
        # Caso contrário, os dados do usuário são resgatados do banco com base no email logado.
        # Então o novo valor do dinheiro do usuário será calculado e será adicionado um ponto de "XP".
        # A seguir serão executados o SQL que salvará o nível e o dinheiro após o clique.
        if (!LoginController::isUserLogged()) {
            echo json_encode(['resposta' => self::ERRO_AO_INICIAR_SESSAO]);
            return false;
        }

        $userModel = self::montarModeloUsuario();
        $newMoney = $userModel->getMoney() + $userModel->getClickValue() * $userModel->getMultiplier();
        $userModel->incrementXpPoints();
        $resultadoSql = self::executarSql($userModel->getLevelData(), $newMoney, $userModel->getEmail());

        if ($resultadoSql) {
            echo json_encode(['resposta' => self::DINHEIRO_SALVO]);
            exit;
        }
        echo json_encode(['resposta' => self::ERRO_AO_SALVAR_DINHEIRO]);
        exit;
    }

    public static function montarModeloUsuario()
    {
        $userModel = new UserModel();
        $userModel->setEmail($_SESSION['email']);
        $userModel->getByEmail();
        return $userModel;
    }

    public static function executarSql($levelData, $money, $email) {
        $conexao = Conexao::criarConexao();
        $newLevel = $levelData->getLevel();
        $newXpPoints = $levelData->getXpPoints();
        $newMaxToUp = $levelData->getMaxToUp();
        $sql = "UPDATE usuario, nivel 
            SET usuario.money = $money, nivel.level = $newLevel, nivel.xp_points = $newXpPoints, nivel.max_to_up = $newMaxToUp 
            WHERE usuario.email = nivel.FK_user_email AND usuario.email = '$email'";
        $sqlPreparado = $conexao->prepare($sql);

        return $sqlPreparado->execute();
    }
}