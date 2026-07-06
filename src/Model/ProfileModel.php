<?php

namespace GbClicker\Model;

use GbClicker\Model\UpgradesInfoModel;

class ProfileModel
{
    public $nickname;
    private UpgradesInfoModel $upgradesInfo;
    public $money;
    public $image_src;
    public $level;
    public $id;
    public $email;

    function __construct()
    {
        $this->upgradesInfo = new UpgradesInfoModel();
    }

    // =-=-=-=-= GETTERS =-=-=-=-=
    public function getId()
    {
        return $this->id;
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
        return $this->money;
    }

    public function getMultiplier()
    {
        return $this->upgradesInfo->getMultiplier();
    }

    public function getMinions()
    {
        return $this->upgradesInfo->getMinions();
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getImageSrc()
    {
        return $this->image_src;
    }

    public function getRank()
    {
        return $this->rank;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUpgradesInfo()
    {
        return $this->upgradesInfo;
    }

    // =-=-=-=-= SETTERS =-=-=-=-=
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function setMoney($money)
    {
        $this->money = $money;
    }

    public function setImageSrc($image_src)
    {
        $this->image_src = $image_src;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}
