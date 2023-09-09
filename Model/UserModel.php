<?php
    class UserModel
    {
        public $email, $password, $nickname, $clickValue, $money, $multiplier;

        public $rows;

        public function save()
        {
            include 'DAO/UserDAO.php';

            $dao = new UserDAO();

            $dao->insert($this);
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

            $this->clickValue = $dao_returnArray['clickValue'];
            $this->money      = $dao_returnArray['money'];
            $this->multiplier = $dao_returnArray['multiplier'];
        }

        public function getByEmail()
        {
            include 'DAO/UserDAO.php';

            $dao = new UserDAO();

            $dao_returnArray  = $dao->selectByEmail($this->email);

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