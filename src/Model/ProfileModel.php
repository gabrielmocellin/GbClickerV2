<?php

namespace GbClicker\Model;

use GbClicker\DAO\ProfileDao;

class ProfileModel
{
    public $nickname;
    public $clickValue;
    public $money;
    public $multiplier;
    public $minions;
    public $image_src;
    public $level;
    public $rank;

    function __construct($id)
    {
        $profileDao = new ProfileDao();
        $profileInfo = $profileDao->selectByIdentifier($id);
        $this->nickname = $profileInfo['nickname'];
        $this->clickValue = $profileInfo['clickValue'];
        $this->money = $profileInfo['money'];
        $this->multiplier = $profileInfo['multiplier'];
        $this->minions = $profileInfo['minions'];
        $this->image_src = $profileInfo['image_src'];;
        $this->level = $profileInfo['level'];
        $this->rank = intval($profileInfo['rank_atual']) + 1;
    }

    // =-=-=-=-= GETTERS =-=-=-=-=
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
}
