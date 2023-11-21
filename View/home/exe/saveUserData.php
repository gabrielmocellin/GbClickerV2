<?php
    if(!isset($_SESSION['email'])){session_start();}

    $email = $_SESSION['email'];

    if(verifyPostInputs()){

        $clickValue = doubleval($_POST['clickValue-input']);
        $money      = doubleval($_POST['money-input']);
        $multiplier = intval($_POST['multiplier-input']);
        
        $minions   = intval($_POST['minions-input']);
        $level     = intval($_POST['level-input']);
        $xp_points = intval($_POST['xp-points-input']);
        $max_to_up = intval($_POST['max-to-up-input']);

        $conexao = new mysqli('localhost', 'gb', 'mysql@204', 'gbclicker_db_mvc');

        $sql = "UPDATE usuario, nivel SET usuario.clickValue=?, usuario.money=?, usuario.multiplier=?, usuario.minions=?,
         nivel.level=?, nivel.xp_points=?, nivel.max_to_up=? WHERE usuario.email = ? AND usuario.email = nivel.FK_user_email";

            $stmt = $conexao->prepare($sql);

            $stmt->bind_param('ddiiiiis',
                $clickValue, $money, $multiplier, $minions, 
                $level, $xp_points, $max_to_up, $email
            );

            $stmt->execute();

    }

    function verifyPostInputs(){
        if(
            isset($_POST['clickValue-input']) && 
            isset($_POST['money-input']) && 
            isset($_POST['multiplier-input']) &&
            isset($_POST['minions-input']) &&
            isset($_POST['level-input']) &&
            isset($_POST['xp-points-input']) &&
            isset($_POST['max-to-up-input'])
        ){
            return true;
        }

        return false;
    }
?>