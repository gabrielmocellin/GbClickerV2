<?php
    class Dao{
        protected $conexao;
        
        public function __construct(){
            // Alterar usuario, senha e nome do bd!
            $this->conexao = new mysqli('localhost', 'gb', 'mysql@204', 'gbclicker_db_mvc'); 
        }
    }