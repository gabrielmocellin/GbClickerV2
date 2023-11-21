<?php
    if(!isset($_SESSION['email'])){session_start();}

    if(verifyPostInputs()){

        $conexao = new mysqli('localhost', 'gb', 'mysql@204', 'gbclicker_db_mvc');

        $email = $_SESSION['email'];

        $clickValue = doubleval($_POST['clickValue-input']);
        $money      = doubleval($_POST['money-input']);
        $multiplier = intval($_POST['multiplier-input']);
        $minions    = intval($_POST['minions-input']);
        
        $sql = "UPDATE usuario SET clickValue = ?, money = ?, multiplier = ?, minions = ? WHERE email = ?";

        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('ddiis', $clickValue, $money, $multiplier, $minions, $email);

        if($stmt->execute()){
            if($stmt->affected_rows > 0){
                header("location: /registrosAtualizados");
            } else{
                header("location: /nenhumRegistroAtualizado");
            }
        } else {
            header("location: /naoFoiPossivelExecutarACompra");
        }

    }

    function verifyPostInputs(){
        if(isset($_SESSION['email'])          && 
            isset($_POST['clickValue-input']) && 
            isset($_POST['money-input'])      && 
            isset($_POST['multiplier-input']) &&
            isset($_POST['minions-input'])
        ){return true;}
        return false;
    }
?>