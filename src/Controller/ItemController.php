<?php

namespace GbClicker\Controller;

use GbClicker\Model\ItemModel;

class ItemController
{
    public static function index()
    {
        $model = AdminPageController::verifyAdminAccount();
        $itemModel = new ItemModel();
        $tipos = $itemModel->getAllTypes();
        include __DIR__ . "\\..\\..\\View\\admin\\addItems.php";
    }
}
