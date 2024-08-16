<?php

namespace Gbclicker\Model;

use GbClicker\DAO\UserDao;
use GbClicker\Model\{LevelModel, UpgradesInfoModel, UserCredentialsModel};

class RegisterModel
{
    public $id;
    public $userCredentials;
    public $nickname;
    public $image_src;
    public $tipo_conta;
    public $upgradesInfo;

    function __construct(
        UserCredentialsModel $userCredentials,
        string $nickname,
        string $image_src,
        UpgradesInfoModel $upgradesInfo = new UpgradesInfoModel(),
        int $tipo_conta = 1
    ) {
        $this->setUserCredentials($userCredentials);
        $this->setNickname($nickname);
        $this->setUpgradesInfo($upgradesInfo);
        $this->setTipoConta($tipo_conta);
        $this->setImageSrc($image_src);
    }

    public function save()
    {
        $dao = new UserDAO();

        if ($dao->register($this)) {
            return true;
        }

        return false;
    }

    // =-=-=-=-= GETTERS =-=-=-=-=
    public function getId()
    {
        return $this->id;
    }

    /*public function getEmail()
    {
        return $this->userCredentials->getEmail();
    }

    public function getPassword()
    {
        return $this->userCredentials->getPassword();
    }*/

    public function getUserCredentials()
    {
        return $this->userCredentials;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getUpgradesInfo()
    {
        return $this->upgradesInfo;
    }

    /*public function getClickValue()
    {
        return $this->upgradesInfo->getClickValue();
    }

    public function getMoney()
    {
        return $this->upgradesInfo->getMoney();
    }

    public function getMultiplier()
    {
        return $this->upgradesInfo->getMultiplier();
    }

    public function getMinions()
    {
        return $this->upgradesInfo->getMinions();
    }

    public function getLevelData()
    {
        return $this->upgradesInfo->getLevelData();
    }*/

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

    public function setUserCredentials(UserCredentialsModel $userCredentialsModel)
    {
        $this->userCredentials = $userCredentialsModel;
    }

    public function setUpgradesInfo(UpgradesInfoModel $upgradesInfoModel)
    {
        $this->upgradesInfo = $upgradesInfoModel;
    }

    /*public function setEmail($email)
    {
        $this->userCredentials->setEmail($email);
    }

    public function setPassword($password)
    {
        $this->userCredentials->setPassword($password);
    }*/

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function setClickValue($clickValue)
    {
        $this->upgradesInfo->setClickValue($clickValue);
    }

    public function setMoney($money)
    {
        $this->upgradesInfo->setMoney($money);
    }

    public function setMultiplier($multiplier)
    {
        $this->upgradesInfo->setMultiplier($multiplier);
    }

    public function setMinions($minions)
    {
        $this->upgradesInfo->setMinions($minions);
    }

    public function setLevelData($level_data)
    {
        $this->upgradesInfo->setLevelData($level_data);
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
