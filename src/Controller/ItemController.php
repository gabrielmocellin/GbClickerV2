<?php

namespace GbClicker\Controller;

use GbClicker\Model\ItemModel;

class ItemController
{
    public function index()
    {
        $model = (new AdminPageController())->verifyAdminAccount();
        $itemModel = new ItemModel();
        $tipos = $itemModel->getAllTypes();
        include __DIR__ . "\\..\\..\\View\\admin\\addItems.php";
    }
}
