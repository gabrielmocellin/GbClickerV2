<?php

namespace GbClicker\Controller;

use GbClicker\Model\{
    UserModel,
    ItemModel
};

class ShopController
{
    public static function index()
    {
        $model = LoginController::login();
        $itemsArray = ShopController::pegarItens();
        $titulo = 'Shop';

        $linksCss = [
            'css/shop.css'
        ];

        $srcJs = [
            'js/Shop/Item.js',
            'js/Shop/items/ClickValue.js',
            'js/Shop/items/Multiplier.js',
            'js/Shop/items/Minions.js',
            'js/util/formatadorNums.js',
            'js/Shop/shop.js'
        ];

        $conteudoMain = '../View/shop/shop.php';

        require_once '../src/Components/template.php';
    }

    public static function pegarItens()
    {
        $itemModel = new ItemModel();
        $itemsArray = $itemModel->getAllItems();
        return $itemsArray;
    }

    public static function mostrarItens($itemsArray)
    {
        if (!empty($itemsArray)) {
            foreach ($itemsArray as $item) {
                $id = $item['id'];
                $descricao = $item['descricao'];
                $imageSrc = $item['image_src'];
                $nome = $item['nome'];
                $quantidade = $item['quantidade'];
                $preco = $item['preco'];

                include ('../src/Components/Shop/item.php');
            }
        } else {
            echo "
                <div class='item'>
                    <p>Não há itens disponíveis no momento...</p>
                </div>
            ";
        }
    }
}
