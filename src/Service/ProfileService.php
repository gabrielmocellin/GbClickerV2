<?php

namespace GbClicker\Service;

use GbClicker\DAO\ProfileDAO;
use GbClicker\Model\ProfileModel;

use GbClicker\DAO\InventarioDAO;

class ProfileService
{
    private ProfileDAO $profileDao;
    private InventarioDAO $inventarioDao;

    public function __construct(ProfileDAO $profileDao, InventarioDAO $inventarioDao)
    {
        $this->profileDao = $profileDao;
        $this->inventarioDao = $inventarioDao;
    }

    public function findById(int $id): ?ProfileModel
    {
        $userData = $this->profileDao->selectByIdentifier($id);
        
        if ($userData) {
            $profile = new ProfileModel();
            $profile->setId($id);
            $profile->setEmail($userData['email']);
            $profile->setNickname($userData['nickname']);
            $profile->setMoney($userData['money']);
            $profile->setImageSrc($userData['image_src']);
            $profile->setLevel($userData['level']);
            $profile->setRank($userData['rank_atual'] + 1);
            
            $inventario = $this->inventarioDao->selectByUserEmail($userData['email']);
            $profile->getUpgradesInfo()->carregarInventario($inventario);
            
            return $profile;
        }
        
        return null;
    }

    public function getRankedPlayers(): array
    {
        $ids = $this->profileDao->selectIdFromRankedPlayers();
        $rankedPlayers = [];
        foreach ($ids as $idArray) {
            $player = $this->findById($idArray['id']);
            if ($player) {
                $rankedPlayers[] = $player;
            }
        }
        return $rankedPlayers;
    }
}
