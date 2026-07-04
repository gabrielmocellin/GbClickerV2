<?php

namespace GbClicker\Controller\Game\Actions;

use GbClicker\Model\UserModel;
use GbClicker\Conexao\Conexao;
use GbClicker\Controller\Auth\LoginController;
use GbClicker\Http\Session;

class MinionsMoneyController
{

    private LoginController $loginController;
    private Session $session;

    public function __construct(LoginController $loginController, Session $session)
    {
        $this->loginController = $loginController;
        $this->session = $session;
    }
    const DINHEIRO_SALVO = 200;
    const ERRO_AO_INICIAR_SESSAO = 201;
    const ERRO_AO_SALVAR_DINHEIRO = 202;

    public function index()
    {
        # Aqui nós primeiro devemos verificar se o usuário está logado (possui uma sessão válida).
        # Caso tenha uma sessão inválida, será retornado um código de erro para inicializar uma notificação ao usuário.
        # Caso contrário, os dados do usuário são resgatados do banco com base no email logado.
        # Então o valor correspondente aos minions deve ser adicionado ao dinheiro do usuário.
        # A seguir são executados o SQL que salva o dinheiro após a alteração.

        if (!$this->loginController->isUserLogged()) {
            echo json_encode(['resposta' => self::ERRO_AO_INICIAR_SESSAO]);
            return false;
        }

        $userModel = $this->montarModeloUsuario();
        $minionsMoney = $userModel->getMinions() * $userModel->getMultiplier();
        $resultadoSql = $this->executarSql($minionsMoney, $userModel->getEmail());

        if ($resultadoSql) {
            echo json_encode(['resposta' => self::DINHEIRO_SALVO]);
            exit;
        }
        echo json_encode(['resposta' => self::ERRO_AO_SALVAR_DINHEIRO]);
        exit;
    }

    public function montarModeloUsuario()
    {
        $userModel = new UserModel();
        $userModel->setEmail($this->session->get('email'));
        $userModel->getByEmail();
        return $userModel;
    }

    public function executarSql($minionsMoney, $email)
    {
        $conexao = Conexao::criarConexao();
        $sql = 'UPDATE usuario
            SET usuario.money = usuario.money + :minionsMoney
            WHERE usuario.email = :email';
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':minionsMoney', $minionsMoney, \PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);

        return $stmt->execute();
    }
}
