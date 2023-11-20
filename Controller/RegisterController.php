<?php 
    class RegisterController
    {

        public static function index()
        {
            include "View/register/register.html";
        }

        public static function register() // Criando nova conta a partir dos dados fornecidos no registro.html
        {
            include 'Model/UserModel.php';

            $model = new UserModel();

            $model->email      = $_POST['email-input'];
            $model->password   = $_POST['password-input'];
            $model->nickname   = $_POST['nickname-input'];
            $model->clickValue = 1;
            $model->money      = 0;
            $model->multiplier = 1;

            if($model->save()){
                header("location: /login");
                return;
            };
            header("location: /?erro=1"); //Não foi possível salvar no bando de dados
        }
    }
?>