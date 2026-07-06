<?php
    namespace GbClicker\Controller\Api;

    use GbClicker\Http\Session;
    use GbClicker\Model\UserModel;
    use GbClicker\Service\UserService;

    class GetUserInfoAPI {
        # Essa classe será utilizada para retornar as informações do usuário
        # a partir do email logado armazenado na SESSION
        const USER_NOT_FOUND = 4005;
        const INVALID_SESSION = 201;
        const COMPLETE = 200;

        private Session $session;
        private UserService $userService;

        public function __construct(Session $session, UserService $userService)
        {
            $this->session = $session;
            $this->userService = $userService;
        }

        public function index()
        {
            $this->loginVerify();
            $email = filter_var($this->session->get('email'), FILTER_SANITIZE_EMAIL);
            
            $model = $this->userService->findByEmail($email);

            if ($model) {
                echo json_encode(
                    [
                        'nickname' => $model->getNickname(),
                        'money' => $model->getMoney(),
                        'clickValue' => $model->getClickValue(),
                        'multiplier' => $model->getMultiplier(),
                        'minions' => $model->getMinions(),
                        'level' => $model->getLevel(),
                        'xp_points' => $model->getXpPoints(),
                        'max_to_up' => $model->getMaxToUp(),
                        'resposta' => self::COMPLETE
                    ]
                );

                exit();
            }

            echo json_encode(
                ['resposta' => self::USER_NOT_FOUND]
            );

            exit();
        }

        public function loginVerify()
        {
            if (!$this->session->has('email')) {
                echo json_encode(['resposta' => self::INVALID_SESSION]);
                exit();
            }
        }

    }
