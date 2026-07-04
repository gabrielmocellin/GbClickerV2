<?php

namespace GbClicker\Controller\Admin;

use GbClicker\Model\ItemModel;

class ItemController
{

    private AdminPageController $adminPageController;

    public function __construct(AdminPageController $adminPageController)
    {
        $this->adminPageController = $adminPageController;
    }
    public function index()
    {
        $model = $this->adminPageController->verifyAdminAccount();
        $itemModel = new ItemModel();
        $tipos = $itemModel->getAllTypes();
        $titulo = 'Admin | Itens';
        $linksCss = ['css/item.css', 'css/adminpages.css'];
        $conteudoMain = '../View/admin/addItems.php';
        require_once '../src/Components/template.php';
    }
}
