<?php

namespace GbClicker\Controller;

use Exception;
use GbClicker\Conexao\Conexao;

class SaveAccountEditController
{
    const EDIT_SUCESS = 0;
    const GENERIC_DATABASE_ERROR = 100;
    const INVALID_NICKNAME = 101;
    const INVALID_CLICK_VALUE = 102;
    const INVALID_MONEY = 103;
    const INVALID_MULTIPLIER = 104;
    const INVALID_MINIONS = 105;
    const DUPLICATED_NICKNAME = 106;
    const SQLSTATE_DUPLICATED_PRIMARY_OR_UNIQUE = 23000;

    public static function index()
    {
        if (!isset($_SESSION['email'])) {
            session_start();
        }

        if ($_SERVER['CONTENT_TYPE'] == "application/json") {

            $dadosRecebidos = file_get_contents("php://input");
            $dadosDecodificados = json_decode($dadosRecebidos, true);
            
            if ($dadosDecodificados != null) {
                $conexao = Conexao::criarConexao();
                $resultadoValidacaoInputs = SaveAccountEditController::validarDados($dadosDecodificados);

                if ($resultadoValidacaoInputs === self::EDIT_SUCESS) {
                    $sqlUsuarioPreparado = SaveAccountEditController::montarSql($conexao, $dadosDecodificados);
                    try {
                        if ($sqlUsuarioPreparado->execute()) {
                            echo json_encode(['resposta' => self::EDIT_SUCESS]);
                            return;
                        } else {
                            echo json_encode(['resposta' => self::GENERIC_DATABASE_ERROR]);
                            return;
                        };
                    } catch (Exception $exception) {
                        echo json_encode(['resposta' => SaveAccountEditController::identificarErros($exception)]);
                        return;
                    }
                } else {
                    echo json_encode(['resposta' => $resultadoValidacaoInputs]);
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
            'nickname'   => ["codigoErro" => self::INVALID_NICKNAME, "regex" => "/^(?=.*[A-z])[A-z0-9_-]{2,16}$/", "dado" => $dados['nickname']],
            'clickValue' => ["codigoErro" => self::INVALID_CLICK_VALUE, "regex" => "/^\d{1,34}$/", "dado" => "" . $dados['clickValue']],
            'money'      => ["codigoErro" => self::INVALID_MONEY, "regex" => "/^\d{1,34}$/", "dado" => "" . $dados['money']],
            'multiplier' => ["codigoErro" => self::INVALID_MULTIPLIER, "regex" => "/^\d{1,34}$/", "dado" => "" . $dados['multiplier']],
            'minions'    => ["codigoErro" => self::INVALID_MINIONS, "regex" => "/^\d{1,34}$/", "dado" => "" . $dados['minions']]
        ];

        foreach ($inputsERespectivosRegex as $inputRegex) {
            $result = preg_match($inputRegex["regex"], $inputRegex["dado"]);
            
            if (!$result) {
                return $inputRegex["codigoErro"];
            }
        };

        return 0;
    }

    public static function identificarErros(Exception $exception)
    {
        if ($exception->getCode() == self::SQLSTATE_DUPLICATED_PRIMARY_OR_UNIQUE) {
            return self::DUPLICATED_NICKNAME;
        }
        return self::GENERIC_DATABASE_ERROR;
    }
}
