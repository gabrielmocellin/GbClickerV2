<?php
    class ImportController{
        public static function dao(){
            require "DAO/Dao.php";
            require "DAO/IDAO.php";
        }

        public static function items(){
            require "DAO/ItemDAO.php";
            require "Model/ItemModel.php";
        }

        public static function user(){
            require "DAO/UserDAO.php";
            require "DAO/LevelDAO.php";
            require "Model/UserModel.php";
            require "Model/LevelModel.php";
        }

        public static function login(){
            require "Controller/LoginController.php";
        }
    }
?>