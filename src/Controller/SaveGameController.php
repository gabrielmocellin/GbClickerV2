<?php

namespace GbClicker\Controller;

use GbClicker\Conexao\Conexao;

class SaveGameController
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
                $sql = "UPDATE usuario, nivel SET 
                    usuario.clickValue=:clickValue, 
                    usuario.money=:money, 
                    usuario.multiplier=:multiplier, 
                    usuario.minions=:minions, 
                    nivel.level=:level, 
                    nivel.xp_points=:xp_points, 
                    nivel.max_to_up=:max_to_up 
                    WHERE usuario.email = :email AND usuario.email = nivel.FK_user_email";

                $conexao = Conexao::criarConexao();

                $sqlUsuarioPreparado = $conexao->prepare($sql);

                $email      = $_SESSION['email'];
                $clickValue = $dadosDecodificados['clickValue'];
                $money      = $dadosDecodificados['money'];
                $multiplier = $dadosDecodificados['multiplier'];
                $minions    = $dadosDecodificados['minions'];
                $level      = $dadosDecodificados['level'];
                $xp_points  = $dadosDecodificados['xp-points'];
                $max_to_up  = $dadosDecodificados['max-to-up'];

                $sqlUsuarioPreparado->bindParam(':clickValue', $clickValue, \PDO::PARAM_INT);
                $sqlUsuarioPreparado->bindParam(':money', $money, \PDO::PARAM_INT);
                $sqlUsuarioPreparado->bindParam(':multiplier', $multiplier, \PDO::PARAM_INT);
                $sqlUsuarioPreparado->bindParam(':minions', $minions, \PDO::PARAM_INT);
                $sqlUsuarioPreparado->bindParam(':level', $level, \PDO::PARAM_INT);
                $sqlUsuarioPreparado->bindParam(':xp_points', $xp_points, \PDO::PARAM_INT);
                $sqlUsuarioPreparado->bindParam(':max_to_up', $max_to_up, \PDO::PARAM_INT);
                $sqlUsuarioPreparado->bindParam(':email', $email, \PDO::PARAM_STR);

                $sqlUsuarioPreparado->execute();
            }
        }
    }
}
