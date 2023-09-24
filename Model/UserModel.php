<?php
    class UserModel
    {
        public $email, $password, $nickname, $clickValue, $money, $multiplier;

        public $rows;

        public function save()
        {
            include 'DAO/UserDAO.php';

            $dao = new UserDAO();

            if($dao->insert($this)){return true;}
            return false;
        }

        public function getAllRows()
        {
            include 'DAO/UserDAO.php';

            $dao = new UserDAO();

            $this->rows = $dao->select();
        }

        public function getByEmailAndPassword()
        {
            include 'DAO/UserDAO.php';

            $dao = new UserDAO();

            $dao_returnArray  = $dao->selectByEmailAndPassword($this->email, $this->password);

            if($dao_returnArray == null){ // Caso não tenha encontrado no banco de dados a conta
                return false;
            }

            $this->clickValue = $dao_returnArray['clickValue'];
            $this->money      = $dao_returnArray['money'];
            $this->multiplier = $dao_returnArray['multiplier'];

            return true;

        }

        public function getByEmail()
        {
            include 'DAO/UserDAO.php';

            $dao = new UserDAO();

            $dao_returnArray  = $dao->selectByEmail($this->email);
            if($dao_returnArray == null){return false;}

            $this->clickValue = $dao_returnArray['clickValue'];
            $this->money      = $dao_returnArray['money'];
            $this->multiplier = $dao_returnArray['multiplier'];
        }

        public function updateUserData()
        {
            include 'DAO/UserDAO.php';

            $dao = new UserDAO();

            $dao->update($this);
        }
    }
?>