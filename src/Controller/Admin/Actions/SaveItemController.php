<?php

namespace GbClicker\Controller\Admin\Actions;

use GbClicker\Model\ItemModel;
use GbClicker\Http\Request;
use GbClicker\Controller\Admin\AdminPageController;

class SaveItemController
{

    private AdminPageController $adminPageController;
    private Request $request;

    public function __construct(AdminPageController $adminPageController, Request $request)
    {
        $this->adminPageController = $adminPageController;
        $this->request = $request;
    }
    public function index()
    {
        $model = $this->adminPageController->verifyAdminAccount();
        if ($model == false) {
            header("location: \\login?aviso=1");
            return;
        }

        // TODO: abstract $_FILES into Request
        if (isset($_FILES['image_src'])) {
            $dirFile = $this->salvarImagemLocalmente($_FILES['image_src']);
            if ($dirFile !== false) { // Pegando o arquivo que está temporário e salvando em uma pasta dentro do projeto
                $item = new ItemModel();
                $item->construtor(
                    $this->request->post('nome'),
                    $this->request->post('descricao'),
                    $this->request->post('preco'),
                    $this->request->post('minimum_level'),
                    $this->request->post('efeito_valor'),
                    $dirFile,
                    $this->request->post('tipo')
                );
                if ($item->save()) {
                    header('location: /admin/items?sucesso=1');
                } else {
                    header('location: /admin/items?erro=1');
                }
            } else {
                header('location: /admin/items?erro=2');
            }
        }
    }

    public function salvarImagemLocalmente($imagem)
    {
        $pathRelativo = "img/uploads/items/";
        $pathCompleto = __DIR__ . "/../../../../public/" . $pathRelativo . basename($imagem['name']);
        if (!move_uploaded_file($imagem['tmp_name'], $pathCompleto)) {
            header("location: /admin/items?erroImagem=7");
            return false;
        };
        return $pathRelativo . basename($imagem['name']);
    }
}
