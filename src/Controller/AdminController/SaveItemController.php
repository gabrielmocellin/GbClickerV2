<?php

namespace GbClicker\Controller\AdminController;

use GbClicker\Model\ItemModel;
use GbClicker\Controller\AdminPageController;

class SaveItemController
{
    public static function index()
    {
        $model = AdminPageController::verifyAdminAccount();
        if ($model == false) {
            header("location: \\login?aviso=1");
            return;
        }

        if (isset($_FILES['image_src'])) {
            $dirFile = SaveItemController::salvarImagemLocalmente($_FILES['image_src']);
            if ($dirFile !== false) { // Pegando o arquivo que está temporário e salvando em uma pasta dentro do projeto
                $item = new ItemModel();
                $item->construtor(
                    $_POST['nome'],
                    $_POST['descricao'],
                    $_POST['preco'],
                    $_POST['minimum_level'],
                    $_POST['quantidade'],
                    $dirFile,
                    $_POST['tipo']
                );
                if ($item->save()) {
                    header('location: \\admin\\items');
                }
            }
        }
    }

    public static function salvarImagemLocalmente($imagem)
    {
        $pathRelativo = "img\\uploads\\items\\";
        $pathCompleto = __DIR__ . "\\..\\..\\..\\public\\$pathRelativo" . basename($imagem['name']);
        if (!move_uploaded_file($imagem['tmp_name'], $pathCompleto)) {
            header("location: \\admin\\items?erroImagem=7");
            return;
        };
        return $pathRelativo . basename($imagem['name']);
    }
}
