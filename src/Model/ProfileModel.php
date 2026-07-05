<?php

namespace GbClicker\Model;

use GbClicker\DAO\ProfileDao;
use GbClicker\Model\UpgradesInfoModel;

class ProfileModel
{
    public $nickname;
    private UpgradesInfoModel $upgradesInfo;
    public $money;
    public $image_src;
    public $level;
    public $id;
    public $rank;

    function __construct($id)
    {
        $profileDao = new ProfileDao();
        $profileInfo = $profileDao->selectByIdentifier($id);
        $this->id = $id;
        $this->nickname = $profileInfo['nickname'];
        $this->money = $profileInfo['money'];
        $this->image_src = $profileInfo['image_src'];
        $this->level = $profileInfo['level'];
        $this->rank = intval($profileInfo['rank_atual']) + 1;

        $this->upgradesInfo = new UpgradesInfoModel();
        // Carrega inventário para calcular as propriedades dinâmicas
        $this->upgradesInfo->carregarInventario($profileInfo['email']);
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
}
