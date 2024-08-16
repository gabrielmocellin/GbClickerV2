<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;
use GbClicker\Conexao\Conexao;
use GbClicker\Controller\LoginController;

class MinionsMoneyController
{
    const DINHEIRO_SALVO = 200;
    const ERRO_AO_INICIAR_SESSAO = 201;
    const ERRO_AO_SALVAR_DINHEIRO = 202;

    public static function index()
    {
        # Aqui nós primeiro devemos verificar se o usuário está logado (possui uma sessão válida).
        # Caso tenha uma sessão inválida, será retornado um código de erro para inicializar uma notificação ao usuário.
        # Caso contrário, os dados do usuário são resgatados do banco com base no email logado.
        # Então o valor correspondente aos minions deve ser adicionado ao dinheiro do usuário.
        # A seguir são executados o SQL que salva o dinheiro após a alteração.

        if (!LoginController::isUserLogged()) {
            echo json_encode(['resposta' => self::ERRO_AO_INICIAR_SESSAO]);
            return false;
        }

        $userModel = self::montarModeloUsuario();
        $minionsMoney = $userModel->getMinions() * $userModel->getMultiplier();
        $resultadoSql = self::executarSql($minionsMoney, $userModel->getEmail());

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

    public static function executarSql($minionsMoney, $email) {
        $conexao = Conexao::criarConexao();
        $sql = "UPDATE usuario SET usuario.money = usuario.money + $minionsMoney WHERE usuario.email = '$email'";
        $sqlPreparado = $conexao->prepare($sql);

        return $sqlPreparado->execute();
    }
}