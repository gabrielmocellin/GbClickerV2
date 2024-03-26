<?php
    namespace GbClicker\Components\Shop;

    use GbClicker\Conexao\Conexao;

    class GetItemQuantAPI {
        const USER_NOT_FOUND = 4005;
        const ITEM_NOT_FOUND = 4004;

        public static function index()
        {
            $id = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT);
            $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
            $resultItem = self::getItemType($id);
 
            if ($resultItem['status'] && $resultItem['resultado'] !== null) {
                $resultUser = self::getUserItemAmount($resultItem['resultado'], $email);

                if ($resultUser['status'] && $resultUser['resultado'] !== null) {
                    echo json_encode(['quantidade' => $resultUser['resultado']]);
                    exit();
                }

                echo json_encode(['resposta' => self::USER_NOT_FOUND]);
                exit();
            }
            echo json_encode(['resposta' => self::ITEM_NOT_FOUND]);
            exit();
        }

        public static function getItemType(int $id)
        {
            $conexao = Conexao::criarConexao();

            $sqlClassificacao = "SELECT classificacao
                FROM tipos_itens
                WHERE tipos_itens.id = :id;
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

        public static function getUserItemAmount(string $item_type, string $email)
        {
            $conexao = Conexao::criarConexao();
            $sql = "SELECT $item_type
            FROM usuario 
            WHERE email = :email;";

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