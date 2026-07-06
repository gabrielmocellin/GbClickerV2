<?php

namespace GbClicker\Controller\Game\Actions;

use GbClicker\Service\UserService;
use GbClicker\Controller\Auth\LoginController;
use GbClicker\Http\Session;

class ClickController
{

    private LoginController $loginController;
    private Session $session;
    private UserService $userService;

    public function __construct(LoginController $loginController, Session $session, UserService $userService)
    {
        $this->loginController = $loginController;
        $this->session = $session;
        $this->userService = $userService;
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

        $userModel = $this->userService->findByEmail($this->session->get('email'));
        if (!$userModel) {
            echo json_encode(['resposta' => self::ERRO_AO_INICIAR_SESSAO]);
            return false;
        }
        
        $newMoney = $userModel->getMoney() + $userModel->getClickValue() * $userModel->getMultiplier();
        $userModel->incrementXpPoints();
        $resultadoSql = $this->userService->updateMoneyAndLevel(
            $userModel->getEmail(), 
            $newMoney, 
            $userModel->upgradesInfo->getLevelData()
        );

        if ($resultadoSql) {
            echo json_encode(['resposta' => self::DINHEIRO_SALVO]);
            exit;
        }
        echo json_encode(['resposta' => self::ERRO_AO_SALVAR_DINHEIRO]);
        exit;
    }

}
