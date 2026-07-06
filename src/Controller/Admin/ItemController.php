<?php

namespace GbClicker\Controller\Admin;

use GbClicker\Model\ItemModel;
use GbClicker\Service\ItemService;

class ItemController
{

    private AdminPageController $adminPageController;
    private ItemService $itemService;

    public function __construct(AdminPageController $adminPageController, ItemService $itemService)
    {
        $this->adminPageController = $adminPageController;
        $this->itemService = $itemService;
    }
    public function index()
    {
        $model = $this->adminPageController->verifyAdminAccount();
        $tipos = $this->itemService->findAllTypes();
        $titulo = 'Admin | Itens';
        $linksCss = ['css/item.css', 'css/adminpages.css'];
        $conteudoMain = '../View/admin/addItems.php';
        require_once '../src/Components/template.php';
    }
}
