<?php 
    class ShopController
    {
        /*
            Ao abrir a loja a sessão é iniciada para recuperar o email logado.
            Após, caso a pessoa estiver logada já seus dados são recuperados do banco de dados.
            Caso não estiver logada é levada a página "home". 
        */
        public static function shop()
        {
            ImportController::dao();
            ImportController::user();
            ImportController::items();

            session_start();

            if(isset($_SESSION['email'])){
                $model        = new UserModel();
                $itemModel    = new ItemModel();
                $model->email = $_SESSION['email'];
        
                $model->getByEmail();
                $itemsArray = $itemModel->getAllItems();
                include ('View/shop/shop.php');
            } else{
                header('location: /login');
            }
        }
    }
?>