<?php

namespace Gbclicker\Model;

use GbClicker\DAO\UserDao;
use GbClicker\Model\LevelModel;

class UserModel
{
    public $id;
    public $email;
    public $password;
    public $nickname;
    public $clickValue;
    public $money;
    public $multiplier;
    public $minions;
    public $image_src;
    public $level_data;
    public $tipo_conta;
    public $rows;

    public function construtor(
        $email,
        $password,
        $nickname,
        $image,
        $clickValue = 1,
        $money = 0,
        $multiplier = 1,
        $minions = 0,
        $tipo_conta = 1
    ) {
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setNickname($nickname);
        $this->setImageSrc($image);
        $this->setClickValue($clickValue);
        $this->setMoney($money);
        $this->setMultiplier($multiplier);
        $this->setMinions($minions);
        $this->setTipoConta($tipo_conta);
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
        $dao_returnArray = $dao->selectByEmailAndPassword($this->getEmail(), $this->getPassword());
        if ($dao_returnArray == null) {
            return false;
        } // Caso não tenha encontrado no banco de dados a conta
        $this->setId($dao_returnArray['id']);
        $this->setNickname($dao_returnArray['nickname']);
        $this->setClickValue($dao_returnArray['clickValue']);
        $this->setMoney($dao_returnArray['money']);
        $this->setMultiplier($dao_returnArray['multiplier']);
        $this->setMinions($dao_returnArray['minions']);
        $this->setImageSrc($dao_returnArray['image_src']);
        $this->setTipoConta($dao_returnArray['tipo_conta']);
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
        $this->setId($dao_returnArray['id']);
        $this->setNickname($dao_returnArray['nickname']);
        $this->setClickValue($dao_returnArray['clickValue']);
        $this->setMoney($dao_returnArray['money']);
        $this->setMultiplier($dao_returnArray['multiplier']);
        $this->setMinions($dao_returnArray['minions']);
        $this->setImageSrc($dao_returnArray['image_src']);
        $this->setTipoConta($dao_returnArray['tipo_conta']);
        $this->setLevelData(new LevelModel($this->email));
    }

    public function updateUserData()
    {
        $dao = new UserDAO();
        $dao->update($this);
    }

    // =-=-=-=-= GETTERS =-=-=-=-=
    public function getId()
    {
        return $this->id;
    }

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

    public function getTipoConta()
    {
        return $this->tipo_conta;
    }


    // =-=-=-=-= SETTERS =-=-=-=-=
    public function setId($id)
    {
        $this->id = $id;
    }

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

    public function setTipoConta($tipo_conta)
    {
        $this->tipo_conta = $tipo_conta;
    }
}
