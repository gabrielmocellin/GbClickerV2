<?php
    namespace GbClicker\Controller\Api;

    use GbClicker\Conexao\Conexao;

    class GetItemQuantAPI {
        const USER_NOT_FOUND = 4005;
        const ITEM_NOT_FOUND = 4004;
        const INVALID_SESSION = 201;
        const COMPLETE = 200;

        /** Colunas permitidas em usuario (alinha com tipos_itens.classificacao). */
        private const COLUNAS_USUARIO_PERMITIDAS = ['clickValue', 'multiplier', 'minions'];

        public function index()
        {
            if (!isset($_SESSION['email'])) {
                echo json_encode(['resposta' => self::INVALID_SESSION]);
                exit();
            }

            $id = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT);
            $email = filter_var($_SESSION['email'], FILTER_SANITIZE_EMAIL);
            $resultItem = self::getItemType($id);
 
            if ($resultItem['status'] && $resultItem['resultado'] !== null) {
                $resultUser = self::getUserItemAmount($resultItem['resultado'], $email);

                if ($resultUser['status'] && $resultUser['resultado'] !== null) {

                    echo json_encode(
                        [
                            'quantidade' => $resultUser['resultado'],
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
            echo json_encode(['resposta' => self::ITEM_NOT_FOUND]);
            exit();
        }

        public function getItemType(int $id)
        {
            $conexao = Conexao::criarConexao();

            $sqlClassificacao = "SELECT classificacao
                FROM itens
                INNER JOIN tipos_itens ON tipos_itens.id = itens.FK_id_tipos_itens
                WHERE itens.id = :id;
            ";

            $stmt = $conexao->prepare($sqlClassificacao);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $executouSql = $stmt->execute();
            $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

            $resultadoIsEmpty = ($resultado == null);

            if ($resultadoIsEmpty) {
                $resultado = ['classificacao' => null];
            }

            return [
                'status' => $executouSql,
                'resultado' => $resultado['classificacao']
            ];
        }

        public function getUserItemAmount(string $item_type, string $email)
        {
            if (!in_array($item_type, self::COLUNAS_USUARIO_PERMITIDAS, true)) {
                return [
                    'status' => false,
                    'resultado' => null,
                ];
            }

            $conexao = Conexao::criarConexao();
            $sql = 'SELECT `' . $item_type . '`
            FROM usuario
            WHERE email = :email';

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $executouSql = $stmt->execute();
            $resultado = $stmt->fetch();


            $resultadoIsEmpty = ($resultado == null);

            if ($resultadoIsEmpty) {
                $resultado = [$item_type => null];
            }

            return [
                'status' => $executouSql,
                'resultado' => $resultado[$item_type]
            ];
        }
    }
