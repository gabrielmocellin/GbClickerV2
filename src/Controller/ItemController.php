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
        if ($model !== false) {
            include __DIR__ . "\\..\\..\\View\\admin\\addItems.php";
            return;
        }
        header("location: \\login?aviso=1");
        return;
    }
}
