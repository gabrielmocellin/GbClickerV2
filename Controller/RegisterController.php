<?php 
    class RegisterController
    {

        public static function index()
        {
            include "View/register/register.html";
        }

        public static function register() // Criando nova conta a partir dos dados fornecidos no registro.html
        {
            $path = 'View/uploads/profile/' . basename($_FILES['image_src']['name']);
            move_uploaded_file($_FILES['image_src']['tmp_name'], $path);

            $model = new UserModel();
            $model->construtor($_POST['email-input'], $_POST['password-input'], $_POST['nickname-input'], $path);

            if($model->save()){
                header("location: /login");
                return;
            };
            header("location: /?erro=1"); //Não foi possível salvar no bando de dados
        }
    }
?>