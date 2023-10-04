<?php
    class ItemDAO{
        private $conexao;

        public function __construct()
        {
            $this->conexao = new mysqli('localhost', 'gb', 'mysql@204', 'gbclicker_db_mvc'); /*ALTERAR O NOME, SENHA E NOME DO BANCO DE DADOS!*/
        }

        public function select(){
            $sql = "SELECT * FROM itens";
            $query_result = $this->conexao->query($sql);
            $results_array = array();

            if($query_result->num_rows > 0){
                while($row = $query_result->fetch_assoc()){
                    $results_array[] = $row;
                }
            } else{
                $results_array = null;
            }

            return $results_array;
        }

    }

?>