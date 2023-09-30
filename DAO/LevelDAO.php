<?php
    class LevelDAO{
        private $conexao;

        public function __construct()
        {
            $this->conexao = new mysqli('localhost', 'gb', 'mysql@204', 'gbclicker_db_mvc'); /*ALTERAR O NOME, SENHA E NOME DO BANCO DE DADOS!*/
        }

        public function select($FK_user_email){
            $sql = "SELECT level, xp_points, max_to_up FROM nivel WHERE FK_user_email = '$FK_user_email'";
            $query_result = $this->conexao->query($sql);
            return $query_result->fetch_assoc();
        }

    }

?>