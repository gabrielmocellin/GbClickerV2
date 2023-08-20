<?php
    class UserModel
    {
        public $email, $password, $nickname, $clickValue, $money;

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

        public function getByEmail()
        {
            include 'DAO/UserDAO.php';

            $dao = new UserDAO();

            $arrayMoneyClick = $dao->selectByEmail($this->email, $this->password);

            $this->clickValue = $arrayMoneyClick['clickValue'];
            $this->money = $arrayMoneyClick['money'];
        }
    }
?>