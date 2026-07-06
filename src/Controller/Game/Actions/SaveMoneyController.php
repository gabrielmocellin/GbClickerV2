<?php

namespace GbClicker\Controller\Game\Actions;

use GbClicker\Service\UserService;
use GbClicker\Controller\Auth\LoginController;
use GbClicker\Http\Session;

class SaveMoneyController
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
        if (!$this->loginController->isUserLogged()) {
            echo json_encode(['resposta' => self::ERRO_AO_INICIAR_SESSAO]);
            return false;
        }

        $userModel = $this->userService->findByEmail($this->session->get('email'));
        if (!$userModel) {
            echo json_encode(['resposta' => self::ERRO_AO_INICIAR_SESSAO]);
            return false;
        }

        $dadosArray = $this->verificarConteudoJson();

        if ($dadosArray != null) {
            $newMoney = $dadosArray['money'] + ($dadosArray['clickValue'] * $dadosArray['multiplier']);
            $userModel->setMoney($newMoney);
            $resultadoSql = $this->userService->updateMoney($userModel);

            if ($resultadoSql) {
                echo json_encode(['resposta' => self::DINHEIRO_SALVO]);
                exit;
            }

            echo json_encode(['resposta' => self::ERRO_AO_SALVAR_DINHEIRO]);
            exit;
        }
    }

    public function verificarConteudoJson()
    {
        // TODO: abstract headers into Request
        if ($_SERVER['CONTENT_TYPE'] == "application/json") {
            $dadosRecebidos = file_get_contents("php://input");
            $dadosDecodificados = json_decode($dadosRecebidos, true);
            return $dadosDecodificados;
        }
        return null;
    }
}
