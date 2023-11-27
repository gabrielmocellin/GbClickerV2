<?php

namespace GbClicker\Controller;

use GbClicker\Conexao\Conexao;

class SaveGameController
{
    public static function index()
    {

        if (!isset($_SESSION['email'])) {
            session_start();
        }
        $email = $_SESSION['email'];
        if (SaveGameController::verifyPostInputs()) {

            $conexao = Conexao::criarConexao();

            $clickValue = doubleval($_POST['clickValue-input']);
            $money = doubleval($_POST['money-input']);
            $multiplier = intval($_POST['multiplier-input']);
            $minions = intval($_POST['minions-input']);
            $level = intval($_POST['level-input']);
            $xp_points = intval($_POST['xp-points-input']);
            $max_to_up = intval($_POST['max-to-up-input']);

            $sql = "UPDATE usuario, nivel SET 
            usuario.clickValue=:clickValue, usuario.money=:money, usuario.multiplier=:multiplier, usuario.minions=:minions, 
            nivel.level=:level, nivel.xp_points=:xp_points, nivel.max_to_up=:max_to_up 
            WHERE usuario.email = :email AND usuario.email = nivel.FK_user_email";

            $sqlUsuarioPreparado = $conexao->prepare($sql);
            
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

    public static function verifyPostInputs()
    {
        if(
            isset($_POST['clickValue-input']) &&
            isset($_POST['money-input']) &&
            isset($_POST['multiplier-input']) &&
            isset($_POST['minions-input']) &&
            isset($_POST['level-input']) &&
            isset($_POST['xp-points-input']) &&
            isset($_POST['max-to-up-input'])
        ) {
            return true;
        }
        return false;
    }
}
