<?php

namespace GbClicker\Model;


class UpgradesInfoModel
{
    public $money;
    public $levelData;
    
    /** @var InventarioModel[] */
    public $inventario = [];
    
    public $statusCalculados = [
        'clickValue' => 1,
        'multiplier' => 1,
        'minions' => 0
    ];

    function __construct(
        $money = 0,
        $levelData = null
    ) {
        if ($levelData === null) {
            $levelData = new LevelModel();
        }
        $this->setMoney($money);
        $this->setLevelData($levelData);
    }
    
    public function carregarInventario(array $inventario)
    {
        $this->inventario = $inventario;
        $this->calcularStatus();
    }
    
    public function calcularStatus()
    {
        // Reseta os status para a base
        $this->statusCalculados = [
            'clickValue' => 1,
            'multiplier' => 1,
            'minions' => 0
        ];
        
        foreach ($this->inventario as $item) {
            $efeito = $item->getEfeito();
            $valorAgregado = $item->getEfeitoValor() * $item->getQuantidade();
            
            if (!isset($this->statusCalculados[$efeito])) {
                $this->statusCalculados[$efeito] = 0;
            }
            $this->statusCalculados[$efeito] += $valorAgregado;
        }
    }

    // =-=-=-=-= GETTERS =-=-=-=-=
    public function getClickValue()
    {
        return $this->statusCalculados['clickValue'] ?? 1;
    }

    public function getMoney()
    {
        return $this->money;
    }

    public function getMultiplier()
    {
        return $this->statusCalculados['multiplier'] ?? 1;
    }

    public function getMinions()
    {
        return $this->statusCalculados['minions'] ?? 0;
    }

    public function getLevelData()
    {
        return $this->levelData;
    }
    
    public function getInventario()
    {
        return $this->inventario;
    }

    public function getStatusCalculados()
    {
        return $this->statusCalculados;
    }

    // =-=-=-=-= SETTERS =-=-=-=-=
    public function setMoney($money)
    {
        $this->money = $money;
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
