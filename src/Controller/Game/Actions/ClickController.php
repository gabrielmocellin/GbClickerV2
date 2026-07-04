<?php

namespace GbClicker\Controller\Game\Actions;

use GbClicker\Model\UserModel;
use GbClicker\Conexao\Conexao;
use GbClicker\Controller\Auth\LoginController;
use GbClicker\Http\Session;

class ClickController
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
        # Então o novo valor do dinheiro do usuário será calculado e será adicionado um ponto de "XP".
        # A seguir serão executados o SQL que salvará o nível e o dinheiro após o clique.
        if (!$this->loginController->isUserLogged()) {
            echo json_encode(['resposta' => self::ERRO_AO_INICIAR_SESSAO]);
            return false;
        }

        $userModel = $this->montarModeloUsuario();
        $newMoney = $userModel->getMoney() + $userModel->getClickValue() * $userModel->getMultiplier();
        $userModel->incrementXpPoints();
        $resultadoSql = $this->executarSql($userModel->getLevelData(), $newMoney, $userModel->getEmail());

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

    public function executarSql($levelData, $money, $email)
    {
        $conexao = Conexao::criarConexao();
        $sql = 'UPDATE usuario, nivel
            SET usuario.money = :money,
                nivel.level = :level,
                nivel.xp_points = :xp_points,
                nivel.max_to_up = :max_to_up
            WHERE usuario.email = nivel.FK_user_email
              AND usuario.email = :email';
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':money', $money, \PDO::PARAM_INT);
        $stmt->bindValue(':level', $levelData->getLevel(), \PDO::PARAM_INT);
        $stmt->bindValue(':xp_points', $levelData->getXpPoints(), \PDO::PARAM_INT);
        $stmt->bindValue(':max_to_up', $levelData->getMaxToUp(), \PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);

        return $stmt->execute();
    }
}
