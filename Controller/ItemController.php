<?php
    class ItemController{
        public static function index(){
            require "View/admin/createItems.php";
        }
        public static function create(){
            require "View/admin/exe/saveItem.php";
        }
    }
?>