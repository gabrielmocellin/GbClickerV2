<?php

namespace Gbclicker\Model;

use GbClicker\DAO\UserDao;
use GbClicker\Model\LevelModel;

class UpgradesInfoModel
{
    public $clickValue;
    public $money;
    public $multiplier;
    public $minions;
    public $levelData;

    function __construct(
        $clickValue = 1,
        $money = 0,
        $multiplier = 1,
        $minions = 0,
        $levelData = new LevelModel()
    ) {
        $this->setClickValue($clickValue);
        $this->setMoney($money);
        $this->setMultiplier($multiplier);
        $this->setMinions($minions);
        $this->setLevelData($levelData);
    }


    // =-=-=-=-= GETTERS =-=-=-=-=
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
        return $this->levelData;
    }


    // =-=-=-=-= SETTERS =-=-=-=-=
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

    public function setLevelData(LevelModel $levelData)
    {
        $this->levelData = $levelData;
    }

    public function getLevel()
    {
        return $this->levelData->getLevel();
    }

    public function getXpPoints()
    {
        return $this->levelData->getXpPoints();
    }

    public function getMaxToUp()
    {
        return $this->levelData->getMaxToUp();
    }

}
