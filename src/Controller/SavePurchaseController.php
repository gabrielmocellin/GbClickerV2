<?php

namespace GbClicker\Controller;
use GbClicker\Model\ItemModel;
use GbClicker\Model\UserModel;
use GbClicker\Conexao\Conexao;

class SavePurchaseController
{
    const ERRO_AO_SALVAR_COMPRA = 4;
    const COMPRA_FINALIZADA = 100;
    const ERRO_AO_INICIAR_SESSAO = 200;

    public static function index()
    {
        $sessaoInicializada = self::verificarSessao();
        if ($sessaoInicializada) {
            $userModel = self::montarModeloUsuario();
            $dadosArray = self::verificarConteudoJson();

            if ($dadosArray != null) {

                $itemModel = self::montarModeloItem($dadosArray['id-item']);
                $resultadoSql = self::executarSql($itemModel, $userModel, $dadosArray['input-quantidade']);

                if ($resultadoSql) {
                    echo json_encode(['resposta' => self::COMPRA_FINALIZADA]);
                    exit();
                }

                echo json_encode(['resposta' => self::ERRO_AO_SALVAR_COMPRA]);
                exit();
            }
        }

    }

    public static function montarModeloUsuario()
    {
        $userModel = new UserModel();
        $userModel->setEmail($_SESSION['email']);
        $userModel->getByEmail();
        return $userModel;
    }

    public static function montarModeloItem($id)
    {
        $itemModel = new ItemModel();
        $itemModel = $itemModel->getById($id);
        return $itemModel;
    }

    public static function verificarSessao()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            echo json_encode(['resposta' => self::ERRO_AO_INICIAR_SESSAO]);
            return false;
        }
        return true;
    }

    public static function verificarConteudoJson()
    {
        if ($_SERVER['CONTENT_TYPE'] == "application/json") {
            $dadosRecebidos = file_get_contents("php://input");
            $dadosDecodificados = json_decode($dadosRecebidos, true);
            return $dadosDecodificados;
        }
        return null;
    }

    public static function executarSql($itemModel, $userModel, $quantidade) {
        $conexao = Conexao::criarConexao();
        $email = $userModel->getEmail();
        $typeIdItem = $itemModel['FK_id_tipos_itens'];
          
        $mapItemType = [
            1 => 'clickValue',
            2 => 'multiplier',
            3 => 'minions'
        ];

        $itemType = $mapItemType[$typeIdItem];

        $sql = "UPDATE usuario SET $itemType = $itemType + $quantidade WHERE email = '$email';";
        $sqlPreparado = $conexao->prepare($sql);

        return $sqlPreparado->execute();
    }
}
