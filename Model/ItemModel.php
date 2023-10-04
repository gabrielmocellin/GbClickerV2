<?php
    class ItemModel{
        public $id, $nome, $descricao, $preco, $minimum_level, $quantidade, $image_src;

        public function getAllItems(){

            include "DAO/ItemDAO.php"; $dao = new ItemDAO();

            return $dao->select();
        }
    }
?>