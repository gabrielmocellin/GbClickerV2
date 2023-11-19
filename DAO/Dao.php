<?php
    class Dao{
        protected $conexao;
        
        public function __construct(){
            // Alterar usuario, senha e nome do bd!
            $this->conexao = new mysqli('localhost', 'xx', 'xx', 'gbclicker_db_mvc'); 
        }
    }