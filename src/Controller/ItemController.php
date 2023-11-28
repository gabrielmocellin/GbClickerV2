<?php

namespace GbClicker\Controller;

use GbClicker\Model\ItemModel;

class ItemController
{
    public static function index()
    {
        require __DIR__ . "\\..\\..\\View\\admin\\createItems.php";
    }
}
