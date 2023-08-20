<?php 
    class UserController
    {
        public static function index(){
            include 'Model/UserModel.php';

            $model = new UserModel();

            $model->email = $_POST['email-input'];
            $model->password = $_POST['password-input'];

            $model->getByEmail();

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

            $model->save();
        }
    }
?>