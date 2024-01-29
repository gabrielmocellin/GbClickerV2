<?php

namespace GbClicker\Controller;

use GbClicker\Conexao\Conexao;

class SaveAccountEditController
{
    public static function index()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("location: /erro404");
        }

        if (!isset($_SESSION['email'])) {
            session_start();
        }

        if ($_SERVER['CONTENT_TYPE'] == "application/json") {

            $dadosRecebidos = file_get_contents("php://input");
            $dadosDecodificados = json_decode($dadosRecebidos, true);
            
            if ($dadosDecodificados != null) {
                $conexao = Conexao::criarConexao();
                $resultadoValidacaoInputs = SaveAccountEditController::validarDados($dadosDecodificados);

                if ($resultadoValidacaoInputs === 0) {
                    $sqlUsuarioPreparado = SaveAccountEditController::montarSql($conexao, $dadosDecodificados);
                    if ($sqlUsuarioPreparado->execute()) {
                        echo json_encode(['resposta' => true]);
                        return;
                    };
                    echo json_encode(['resposta' => false]);
                    return;
                }
                
            }
        }
    }

    public static function montarSql($conexao, $dados)
    {
        $sql = "UPDATE usuario
                SET nickname=:nickname,
                clickValue=:clickValue,
                money=:money,
                multiplier=:multiplier,
                minions=:minions
                WHERE id = :id;";

        $sqlPreparado = $conexao->prepare($sql);

        $id         = $dados['id'];
        $nickname   = $dados['nickname'];
        $clickValue = $dados['clickValue'];
        $money      = $dados['money'];
        $multiplier = $dados['multiplier'];
        $minions    = $dados['minions'];

        $sqlPreparado->bindParam(':nickname', $nickname, \PDO::PARAM_STR);
        $sqlPreparado->bindParam(':clickValue', $clickValue, \PDO::PARAM_INT);
        $sqlPreparado->bindParam(':money', $money, \PDO::PARAM_INT);
        $sqlPreparado->bindParam(':multiplier', $multiplier, \PDO::PARAM_INT);
        $sqlPreparado->bindParam(':minions', $minions, \PDO::PARAM_INT);
        $sqlPreparado->bindParam(':id', $id, \PDO::PARAM_INT);

        return $sqlPreparado;
    }

    public static function validarDados($dados)
    {
        $inputsERespectivosRegex = [
            'nickname' => ["codigoErro" => 1, "regex" => "/^(?=.*[A-z])[A-z0-9_-]{2,16}$/", "dado" => $dados['nickname']],
            'clickValue' => ["codigoErro" => 2, "regex" => "/^\d{1,34}$/", "dado" => "" . $dados['clickValue']],
            'money' => ["codigoErro" => 3, "regex" => "/^\d{1,34}$/", "dado" => "" . $dados['money']],
            'multiplier' => ["codigoErro" => 4, "regex" => "/^\d{1,34}$/", "dado" => "" . $dados['multiplier']],
            'minions' => ["codigoErro" => 5, "regex" => "/^\d{1,34}$/", "dado" => "" . $dados['minions']],
        ];

        foreach ($inputsERespectivosRegex as $inputRegex) {
            $result = preg_match($inputRegex["regex"], $inputRegex["dado"]);
            if (!$result) {
                return $inputRegex["codigoErro"];
            }
        };

        return 0;
    }
}
