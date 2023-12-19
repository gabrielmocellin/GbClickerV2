<?php

namespace GbClicker\Model;

use GbClicker\DAO\ProfileDao;

class RankModel
{
    public $profileDao;

    public function __construct()
    {
        $this->profileDao = new ProfileDao();
    }

    public function getArrayInfoRankedPlayers()
    {
        $rankedPlayersId = $this->profileDao->selectIdFromRankedPlayers();
        $arrayInfoPlayers = [];
        foreach ($rankedPlayersId as $player) {
            $arrayInfoPlayers[] = new ProfileModel($player['id']);
        }
        return $arrayInfoPlayers;
    }
}
