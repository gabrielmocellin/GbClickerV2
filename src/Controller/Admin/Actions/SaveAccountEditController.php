<?php

namespace GbClicker\Controller\Admin\Actions;

use Exception;
use GbClicker\Conexao\Conexao;
use GbClicker\Http\Session;

class SaveAccountEditController
{
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    const EDIT_SUCESS = 0;
    const GENERIC_DATABASE_ERROR = 100;
    const INVALID_NICKNAME = 101;
    const INVALID_CLICK_VALUE = 102;
    const INVALID_MONEY = 103;
    const INVALID_MULTIPLIER = 104;
    const INVALID_MINIONS = 105;
    const DUPLICATED_NICKNAME = 106;
    const SQLSTATE_DUPLICATED_PRIMARY_OR_UNIQUE = 23000;

    public function index()
    {
        if (!$this->session->has('email')) {

        }

        // TODO: abstract headers into Request
        if ($_SERVER['CONTENT_TYPE'] == "application/json") {

            $dadosRecebidos = file_get_contents("php://input");
            $dadosDecodificados = json_decode($dadosRecebidos, true);
            
            if ($dadosDecodificados != null) {
                $conexao = Conexao::criarConexao();
                $resultadoValidacaoInputs = $this->validarDados($dadosDecodificados);

                if ($resultadoValidacaoInputs === self::EDIT_SUCESS) {
                    $sqlUsuarioPreparado = $this->montarSql($conexao, $dadosDecodificados);
                    try {
                        if ($sqlUsuarioPreparado->execute()) {
                            echo json_encode(['resposta' => self::EDIT_SUCESS]);
                            return;
                        } else {
                            echo json_encode(['resposta' => self::GENERIC_DATABASE_ERROR]);
                            return;
                        };
                    } catch (Exception $exception) {
                        echo json_encode(['resposta' => $this->identificarErros($exception)]);
                        return;
                    }
                } else {
                    echo json_encode(['resposta' => $resultadoValidacaoInputs]);
                    return;
                }
                
            }
        }
    }

    public function montarSql($conexao, $dados)
    {
        $sql = "UPDATE usuario
                SET nickname=:nickname,
                money=:money
                WHERE id = :id;";

        $sqlPreparado = $conexao->prepare($sql);

        $id         = $dados['id'];
        $nickname   = $dados['nickname'];
        $money      = $dados['money'];

        $sqlPreparado->bindParam(':nickname', $nickname, \PDO::PARAM_STR);
        $sqlPreparado->bindParam(':money', $money, \PDO::PARAM_INT);
        $sqlPreparado->bindParam(':id', $id, \PDO::PARAM_INT);

        return $sqlPreparado;
    }

    public function validarDados($dados)
    {
        $inputsERespectivosRegex = [
            'nickname'   => ["codigoErro" => self::INVALID_NICKNAME, "regex" => "/^(?=.*[A-z])[A-z0-9_-]{2,16}$/", "dado" => $dados['nickname']],
            'money'      => ["codigoErro" => self::INVALID_MONEY, "regex" => "/^\d{1,34}$/", "dado" => "" . $dados['money']]
        ];

        foreach ($inputsERespectivosRegex as $inputRegex) {
            $result = preg_match($inputRegex["regex"], $inputRegex["dado"]);
            
            if (!$result) {
                return $inputRegex["codigoErro"];
            }
        };

        return 0;
    }

    public function identificarErros(Exception $exception)
    {
        if ($exception->getCode() == self::SQLSTATE_DUPLICATED_PRIMARY_OR_UNIQUE) {
            return self::DUPLICATED_NICKNAME;
        }
        return self::GENERIC_DATABASE_ERROR;
    }
}
