<?php

namespace GbClicker\Controller;
use GbClicker\Model\ItemModel;
use GbClicker\Model\UserModel;
use GbClicker\Conexao\Conexao;

class SavePurchaseController
{
    public static function index()
    {
        if (SavePurchaseController::isSessaoIniciada()) {

        }
        $email = $_SESSION['email'];
        $idItem = $_POST['id-item'];
        $precoTotal = $_POST['preco-total'];
        $quantidade = $_POST['input-quantidade'];

        $itemModel = new ItemModel();
        $itemDados = $itemModel->getById($idItem);
        $dadosDecodificados = SavePurchaseController::verificarConteudoRecebidoJson();

        var_dump($itemDados);
        echo "<br><br>";
        var_dump($dadosDecodificados);

        if ($dadosDecodificados != null) {
            $conexao = Conexao::criarConexao();
        }
    }

    public static function isSessaoIniciada()
    {
        session_start();
        $isSessaoIniciada = isset($_SESSION['email']);
        return $isSessaoIniciada;
    }

    public static function verificarConteudoRecebidoJson()
    {
        if ($_SERVER['CONTENT_TYPE'] == "application/json") {
            $dadosRecebidos = file_get_contents("php://input");
            $dadosDecodificados = json_decode($dadosRecebidos, true);
            
            return $dadosDecodificados;
        } else {
            return null;
        }
    }
}
