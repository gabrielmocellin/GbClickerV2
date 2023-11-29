<?php

namespace Gbclicker\Model;

use GbClicker\DAO\UserDao;
use GbClicker\Model\LevelModel;

class UserModel
{
    public $email;
    public $password;
    public $nickname;
    public $clickValue;
    public $money;
    public $multiplier;
    public $minions;
    public $image_src;
    public $level_data;
    public $rows;

    public function construtor($email, $password, $nickname, $image, $clickValue = 1, $money = 0, $multiplier = 1, $minions = 0)
    {
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setNickname($nickname);
        $this->setImageSrc($image);
        $this->setClickValue($clickValue);
        $this->setMoney($money);
        $this->setMultiplier($multiplier);
        $this->setMinions($minions);
    }

    public function save()
    {
        $dao = new UserDAO();
        if ($dao->insert($this)) {
            return true;
        }
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
        $dao_returnArray  = $dao->selectByEmailAndPassword($this->getEmail(), $this->getPassword());
        if ($dao_returnArray == null) {
            return false;
        } // Caso não tenha encontrado no banco de dados a conta
        $this->setClickValue($dao_returnArray[0]['clickValue']);
        $this->setMoney($dao_returnArray[0]['money']);
        $this->setMultiplier($dao_returnArray[0]['multiplier']);
        $this->setMinions($dao_returnArray[0]['minions']);
        $this->setImageSrc($dao_returnArray[0]['image_src']);
        $this->setLevelData(new LevelModel($this->getEmail()));
        return true;
    }

    public function getByEmail()
    {
        $dao = new UserDAO();

        $dao_returnArray  = $dao->selectByEmail($this->getEmail());
        if ($dao_returnArray == null) {
            return false;
        }
        $this->setClickValue($dao_returnArray[0]['clickValue']);
        $this->setMoney($dao_returnArray[0]['money']);
        $this->setMultiplier($dao_returnArray[0]['multiplier']);
        $this->setMinions($dao_returnArray[0]['minions']);
        $this->setImageSrc($dao_returnArray[0]['image_src']);
        $this->setLevelData(new LevelModel($this->email));
    }

    public function updateUserData()
    {
        $dao = new UserDAO();
        $dao->update($this);
    }

    // =-=-=-=-= GETTERS =-=-=-=-=
    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getClickValue()
    {
        return $this->clickValue;
    }

    public function getMoney()
    {
        return $this->money;
    }

    public function getMultiplier()
    {
        return $this->multiplier;
    }

    public function getMinions()
    {
        return $this->minions;
    }

    public function getLevelData()
    {
        return $this->level_data;
    }

    public function getImageSrc()
    {
        return $this->image_src;
    }

    // =-=-=-=-= SETTERS =-=-=-=-=
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function setClickValue($clickValue)
    {
        $this->clickValue = $clickValue;
    }

    public function setMoney($money)
    {
        $this->money = $money;
    }

    public function setMultiplier($multiplier)
    {
        $this->multiplier = $multiplier;
    }

    public function setMinions($minions)
    {
        $this->minions = $minions;
    }

    public function setLevelData($level_data)
    {
        $this->level_data = $level_data;
    }

    public function setImageSrc($image_src)
    {
        $this->image_src = $image_src;
    }
}
