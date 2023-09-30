<?php
    class UserDAO
    {
        private $conexao;

        public function __construct()
        {
            $this->conexao = new mysqli('localhost', 'gb', 'mysql@204', 'gbclicker_db_mvc'); /*ALTERAR O NOME, SENHA E NOME DO BANCO DE DADOS!*/
        }

        public function insert(UserModel $model)
        {
            $sqlUser = "INSERT INTO usuario (email, password, nickname, clickValue, money, multiplier) VALUES (?, ?, ?, ?, ?, ?)";
            $sqlLevel = "INSERT INTO nivel (FK_user_email, level, xp_points, max_to_up) VALUES (?, 1, 0, 10)";

            $stmtUser = $this->conexao->prepare($sqlUser);
            $stmtLevel = $this->conexao->prepare($sqlLevel);

            $stmtUser->bind_param('sssddi', 
                $model->email,
                $model->password,
                $model->nickname,
                $model->clickValue,
                $model->money,
                $model->multiplier
            );

            $stmtLevel->bind_param('s', $model->email);

            if($stmtUser->execute() && $stmtLevel->execute()){
                return true;
            }
            return false;
        }

        public function update(UserModel $model)
        {
            $sql = "UPDATE usuario SET clickValue=?, money=? WHERE email = ?";

            $stmt = $this->conexao->prepare($sql);

            $stmt->bind_param('dds',
            $model->clickValue,
            $model->money,
            $model->email
            );

            $stmt->execute();
        }

        public function select()
        {
            $sql = "SELECT * FROM usuario";

            $stmt = $this->conexao->query($sql);

            return $stmt->fetch_all(MYSQLI_ASSOC);
        }

        public function selectByEmailAndPassword(string $email, string $password){

            $sql = "SELECT * FROM usuario JOIN nivel WHERE usuario.email = nivel.FK_user_email and usuario.email = '$email' and password = '$password'";

            $stmt = $this->conexao->query($sql);

            return $stmt->fetch_assoc();
        }

        public function selectByEmail(string $email){
            $sql = "SELECT * FROM usuario WHERE email = '$email'";

            $stmt = $this->conexao->query($sql);

            return $stmt->fetch_assoc();
        }



        public function delete(string $email)
        {
            $sql = "DELETE FROM usuario WHERE email = ?";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bind_param('s', $email);

            $stmt->execute();
        }
    }
?>