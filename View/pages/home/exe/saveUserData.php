<?php
    if(!isset($_SESSION['email'])){session_start();}

    $email = $_SESSION['email'];

    if(
    isset($_SESSION['email']) && 
    isset($_POST['clickValue-input']) && 
    isset($_POST['money-input']) &&
    isset($_POST['multiplier-input'])
    ){

        $clickValue = doubleval($_POST['clickValue-input']);
        $money      = doubleval($_POST['money-input']);
        $multiplier = intval($_POST['multiplier-input']);

        $conexao = new mysqli('localhost', 'gb', 'mysql@204', 'gbclicker_db_mvc');

        $sql = "UPDATE usuario SET clickValue=?, money=?, multiplier=? WHERE email = ?";

            $stmt = $conexao->prepare($sql);

            $stmt->bind_param('ddis', $clickValue, $money, $multiplier, $email);

            $stmt->execute();

    }
?>