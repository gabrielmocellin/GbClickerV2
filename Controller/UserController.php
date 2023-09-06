<?php 
    class UserController
    {
        public static function index(){
            include 'Model/UserModel.php';
            
            session_start();
            
            if(isset($_POST['email-input']) && isset($_POST['password-input'])){

                $model = new UserModel();

                $model->email = $_POST['email-input'];
                $model->password = $_POST['password-input'];
    
                $model->getByEmailAndPassword();

                $_SESSION['email'] = $model->email;
                $_POST = array();

            } else if(isset($_SESSION['email'])){

                $model = new UserModel();

                $model->email = $_SESSION['email'];
        
                $model->getByEmail();
            }
            require 'View/pages/home/home.php';

        }

        public static function form()
        {
            include "View/pages/register/register.html";
        }

        public static function save()
        {
            include 'Model/UserModel.php';

            $model = new UserModel();

            $model->email =    $_POST['email-input'];
            $model->password = $_POST['password-input'];
            $model->nickname = $_POST['nickname-input'];
            $model->clickValue = 1;
            $model->money = 0;
            $model->multiplier = 1;

            $model->save();
        }

        /* Ao abrir a loja a sessão é iniciada para recuperar o email logado.
           Após, caso a pessoa estiver logada já seus dados são recuperados do banco de dados.
           Caso não estiver logada é levada a página "home". */
        public static function shop()
        {
            include 'Model/UserModel.php';

            session_start();

            if(isset($_SESSION['email'])){
                $model = new UserModel();
        
                $model->email = $_SESSION['email'];
        
                $model->getByEmail();
    
                include 'View/pages/shop/shop.php';
            } else{header('location: /');}
        }
    }
?>