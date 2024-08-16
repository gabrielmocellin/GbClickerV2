<?php

namespace GbClicker\Model;

use GbClicker\DAO\LevelDao;

class LevelModel
{
    public $level;
    public $xpPoints;
    public $maxToUp;
    const PORCENTAGEM_INCREMENTADA_PONTOS_PARA_UPAR = 1.1;

    public function __construct (
        $level = 1,
        $xpPoints = 0,
        $maxToUp = 10
    ) {
        $this->setLevel($level);
        $this->setMaxToUp($maxToUp);
        $this->setXpPoints($xpPoints);
    }

    public function incrementXpPoints($xpPoints)
    {
        $this->setXpPoints($this->getXpPoints() + $xpPoints);
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getXpPoints()
    {
        return $this->xpPoints;
    }

    public function getMaxToUp()
    {
        return $this->maxToUp;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function setXpPoints($newXpPoints)
    {
        # Enquanto o novo valor do XP for maior que o limite para subir de nível
        # Devemos subtrair o valor limite do XP atual para evoluir de nível
        # e então, incrementar tanto o valor limite como o nível e atualizando o valor XP atual
        while ($newXpPoints >= $this->getMaxToUp()) {
            $newXpPoints -= $this->getMaxToUp();
            $newMaxToUp = $this->getMaxToUp() * self::PORCENTAGEM_INCREMENTADA_PONTOS_PARA_UPAR;
            $this->setMaxToUp($newMaxToUp);
            $this->setLevel($this->getLevel() + 1);
            
        }

        $this->xpPoints = $newXpPoints;
    }

    public function setMaxToUp($maxToUp)
    {
        $this->maxToUp = $maxToUp;
    }
}
