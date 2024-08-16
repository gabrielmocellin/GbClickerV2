<?php
    namespace GbClicker\Components\Home;

    use GbClicker\Conexao\Conexao;
    use GbClicker\Model\UserModel;

    class GetUserInfoAPI {
        # Essa classe será utilizada para retornar as informações do usuário
        # a partir do email logado armazenado na SESSION
        const USER_NOT_FOUND = 4005;
        const INVALID_SESSION = 201;
        const COMPLETE = 200;

        public static function index()
        {
            self::loginVerify();
            $email = filter_var($_SESSION['email'], FILTER_SANITIZE_EMAIL);
            $model = new UserModel();
            $model->setEmail($email);

            if ($model->getByEmail()) {
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

        public static function loginVerify()
        {
            session_start();
            if (!isset($_SESSION['email'])) {
                echo json_encode(['resposta' => self::INVALID_SESSION]);
                exit();
            }
        }

    }