<?php
    namespace GbClicker\Controller\Api;

    use GbClicker\Conexao\Conexao;
    use GbClicker\Http\Request;
    use GbClicker\Http\Session;

    class GetItemQuantAPI {
        const USER_NOT_FOUND = 4005;
        const ITEM_NOT_FOUND = 4004;
        const INVALID_SESSION = 201;
        const COMPLETE = 200;

        private Session $session;
        private Request $request;

        public function __construct(Session $session, Request $request)
        {
            $this->session = $session;
            $this->request = $request;
        }

        public function index()
        {
            if (!$this->session->has('email')) {
                echo json_encode(['resposta' => self::INVALID_SESSION]);
                exit();
            }

            $id = filter_var($this->request->get('item_id'), FILTER_SANITIZE_NUMBER_INT);
            $email = filter_var($this->session->get('email'), FILTER_SANITIZE_EMAIL);
            
            $resultUser = $this->getUserItemAmount($id, $email);

            if ($resultUser['status']) {
                echo json_encode(
                    [
                        'quantidade' => $resultUser['resultado'] ?? 0,
                        'resposta' => self::COMPLETE
                    ]
                );
                exit();
            }

            echo json_encode(['resposta' => self::USER_NOT_FOUND]);
            exit();
        }

        public function getUserItemAmount(int $item_id, string $email)
        {
            $conexao = Conexao::criarConexao();
            $sql = 'SELECT quantidade
            FROM inventario
            WHERE FK_user_email = :email AND FK_item_id = :item_id';

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->bindParam(':item_id', $item_id, \PDO::PARAM_INT);
            $executouSql = $stmt->execute();
            $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

            return [
                'status' => $executouSql,
                'resultado' => $resultado ? (int)$resultado['quantidade'] : 0
            ];
        }
    }
