<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;
use GbClicker\Conexao\Conexao;
use GbClicker\Controller\LoginController;

class SaveMoneyController
{
    const DINHEIRO_SALVO = 200;
    const ERRO_AO_INICIAR_SESSAO = 201;
    const ERRO_AO_SALVAR_DINHEIRO = 202;

    public static function index()
    {
        if (!LoginController::isUserLogged()) {
            echo json_encode(['resposta' => self::ERRO_AO_INICIAR_SESSAO]);
            return false;
        }

        $userModel = self::montarModeloUsuario();
        $dadosArray = self::verificarConteudoJson();

        if ($dadosArray != null) {
            $resultadoSql = self::executarSql($dadosArray['money'], $userModel->getEmail());

            if ($resultadoSql) {
                echo json_encode(['resposta' => self::DINHEIRO_SALVO]);
                exit;
            }

            echo json_encode(['resposta' => self::ERRO_AO_SALVAR_DINHEIRO]);
            exit;
        }
    }

    public static function montarModeloUsuario()
    {
        $userModel = new UserModel();
        $userModel->setEmail($_SESSION['email']);
        $userModel->getByEmail();
        return $userModel;
    }

    public static function verificarConteudoJson()
    {
        if ($_SERVER['CONTENT_TYPE'] == "application/json") {
            $dadosRecebidos = file_get_contents("php://input");
            $dadosDecodificados = json_decode($dadosRecebidos, true);
            return $dadosDecodificados;
        }
        return null;
    }

    public static function executarSql($money, $email) {
        $conexao = Conexao::criarConexao();
        $sql = "UPDATE usuario SET money = $money WHERE email = '$email'";
        $sqlPreparado = $conexao->prepare($sql);

        return $sqlPreparado->execute();
    }
}