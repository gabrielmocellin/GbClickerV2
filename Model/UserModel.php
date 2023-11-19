<?php
    require_once 'DAO/Dao.php';
    require_once 'DAO/IDAO.php';
    require_once 'DAO/UserDAO.php';

    class UserModel
    {
        public $email, $password, $nickname;
        public $clickValue, $money, $multiplier;
        public $level_data;

        public $rows;

        public function save()
        {
            $dao = new UserDAO();
            if($dao->insert($this))
                return true;
            return false;
        }

        public function getAllRows()
        {
            $dao = new UserDAO();
            $this->rows = $dao->select();
        }

        public function getByEmailAndPassword()
        {
            $dao = new UserDAO();

            $dao_returnArray  = $dao->selectByEmailAndPassword($this->email, $this->password);

            if($dao_returnArray == null){ // Caso não tenha encontrado no banco de dados a conta
                return false;
            }

            $this->clickValue = $dao_returnArray['clickValue'];
            $this->money      = $dao_returnArray['money'];
            $this->multiplier = $dao_returnArray['multiplier'];

            $this->getLevelData();

            return true;
        }

        public function getByEmail()
        {
            $dao = new UserDAO();
            $dao_returnArray  = $dao->selectByEmail($this->email);

            if($dao_returnArray == null)
                return false;

            $this->clickValue = $dao_returnArray['clickValue'];
            $this->money      = $dao_returnArray['money'];
            $this->multiplier = $dao_returnArray['multiplier'];
            $this->getLevelData();
        }

        public function updateUserData()
        {
            $dao = new UserDAO();
            $dao->update($this);
        }

        public function getLevelData(){
            include "Model/LevelModel.php";
            $this->level_data = new LevelModel($this->email);
        }
    }
?>