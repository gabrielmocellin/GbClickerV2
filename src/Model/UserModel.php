<?php

# Essa classe deve ser utilizada para o salvamento de informações no banco e recebimento dessas informações

namespace GbClicker\Model;

use GbClicker\Model\{LevelModel, UpgradesInfoModel, UserCredentialsModel};

class UserModel
{
    public $id;
    public $userCredentials;
    public $nickname;
    public $image_src;
    public $tipo_conta;
    public $upgradesInfo;
    public $rows;

    public function __construct()
    {
        $this->userCredentials = new UserCredentialsModel();
        $this->upgradesInfo = new UpgradesInfoModel();
    }



    public function setAllUserData($daoResult)
    {
        $this->setId($daoResult['id']);
        $this->setNickname($daoResult['nickname']);
        $this->setMoney($daoResult['money']);
        $this->setImageSrc($daoResult['image_src']);
        $this->setTipoConta($daoResult['tipo_conta']);
        $this->setLevelData(new LevelModel(
            $daoResult['level'],
            $daoResult['xp_points'],
            $daoResult['max_to_up']
        ));
        

    }



    public function incrementXpPoints($xpPoints = 1)
    {
        $this->getLevelData()->incrementXpPoints($xpPoints);
    }

    // =-=-=-=-= GETTERS =-=-=-=-=
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->userCredentials->getEmail();
    }

    public function getPassword()
    {
        return $this->userCredentials->getPassword();
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getClickValue()
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
        return $this->upgradesInfo->levelData;
    }

    public function getImageSrc()
    {
        return $this->image_src;
    }

    public function getTipoConta()
    {
        return $this->tipo_conta;
    }

    public function getLevel()
    {
        return $this->upgradesInfo->getLevel();
    }

    public function getXpPoints()
    {
        return $this->upgradesInfo->getXpPoints();
    }

    public function getMaxToUp()
    {
        return $this->upgradesInfo->getMaxToUp();
    }


    // =-=-=-=-= SETTERS =-=-=-=-=
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->userCredentials->setEmail($email);
    }

    public function setPassword($password)
    {
        $this->userCredentials->setPassword($password);
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function setMoney($money)
    {
        $this->upgradesInfo->setMoney($money);
    }

    public function setLevelData($levelData)
    {
        $this->upgradesInfo->setLevelData($levelData);
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
