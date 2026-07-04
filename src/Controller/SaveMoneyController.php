<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;
use GbClicker\Conexao\Conexao;
use GbClicker\Controller\LoginController;

class SaveMoneyController
{

    private LoginController $loginController;

    public function __construct(LoginController $loginController)
    {
        $this->loginController = $loginController;
    }
    const DINHEIRO_SALVO = 200;
    const ERRO_AO_INICIAR_SESSAO = 201;
    const ERRO_AO_SALVAR_DINHEIRO = 202;

    public function index()
    {
        if (!$this->loginController->isUserLogged()) {
            echo json_encode(['resposta' => self::ERRO_AO_INICIAR_SESSAO]);
            return false;
        }

        $userModel = self::montarModeloUsuario();
        $dadosArray = self::verificarConteudoJson();

        if ($dadosArray != null) {
            $newMoney = $dadosArray['money'] + ($dadosArray['clickValue'] * $dadosArray['multiplier']);
            $resultadoSql = self::executarSql($newMoney, $userModel->getEmail());

            if ($resultadoSql) {
                echo json_encode(['resposta' => self::DINHEIRO_SALVO]);
                exit;
            }

            echo json_encode(['resposta' => self::ERRO_AO_SALVAR_DINHEIRO]);
            exit;
        }
    }

    public function montarModeloUsuario()
    {
        $userModel = new UserModel();
        $userModel->setEmail($_SESSION['email']);
        $userModel->getByEmail();
        return $userModel;
    }

    public function verificarConteudoJson()
    {
        if ($_SERVER['CONTENT_TYPE'] == "application/json") {
            $dadosRecebidos = file_get_contents("php://input");
            $dadosDecodificados = json_decode($dadosRecebidos, true);
            return $dadosDecodificados;
        }
        return null;
    }

    public function executarSql($money, $email)
    {
        $conexao = Conexao::criarConexao();
        $sql = 'UPDATE usuario SET money = :money WHERE email = :email';
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':money', $money, \PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);

        return $stmt->execute();
    }
}
