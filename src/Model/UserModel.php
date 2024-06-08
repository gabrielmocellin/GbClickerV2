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

    public function getFirstTenAccoutsByPage(int $page)
    {
        $fim    = $page * 10;
        $inicio = $fim - 10;
        $dao    = new UserDAO();
        $contas = $dao->selectTenPerPage($inicio, $fim);
        $contas = UserModel::elementosResultadosDeQueryParaUserModel($contas);
        return $contas;
    }

    public static function elementosResultadosDeQueryParaUserModel($resultado)
    {
        $contas = array_map(
            function ($conta) {
                $contaCriada = new UserModel();
                $contaCriada->setEmail($conta['email']);
                $contaCriada->getByEmail();
                return $contaCriada;
            }, $resultado
        );

        return $contas;
        
    }

    public function dataFoundByEmailAndPassword()
    {
        $dao = new UserDAO();
        $daoResult  = $dao->selectByEmail($this->getEmail());
        $correctPassword = password_verify($this->getPassword(), $daoResult['password'] ?? '');
        
        if (!$correctPassword) {
            return false;
        }

        $this->setAllUserData($daoResult);
        return true;
    }

    public function getByEmail()
    {
        $dao = new UserDAO();
        $daoResult  = $dao->selectByEmail($this->getEmail());

        if ($daoResult == null) {
            return false;
        }

        $this->setAllUserData($daoResult);
    }

    public function setAllUserData($daoResult)
    {
        $this->setId($daoResult['id']);
        $this->setNickname($daoResult['nickname']);
        $this->setClickValue($daoResult['clickValue']);
        $this->setMoney($daoResult['money']);
        $this->setMultiplier($daoResult['multiplier']);
        $this->setMinions($daoResult['minions']);
        $this->setImageSrc($daoResult['image_src']);
        $this->setTipoConta($daoResult['tipo_conta']);
        $this->setLevelData(new LevelModel($this->getEmail()));
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
