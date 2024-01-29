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
        include_once __DIR__ . '/../../View/shop/shop.php';
    }

    public static function pegarItens()
    {
        $itemModel = new ItemModel();
        $itemsArray = $itemModel->getAllItems();
        return $itemsArray;
    }

    public static function identificarItens($itemsArray)
    {
        if (!empty($itemsArray)) {
            foreach ($itemsArray as $item) {
                echo "itensArray['" . $item['id'] . "'] =
                    new " . $item['classificacao'] . "(
                    " . $item['id'] . ",
                    " . $item['preco'] . ",
                    " . $item['minimum_level'] . ",
                    " . $item['quantidade'] . ",
                    '" . $item['nome'] . "'
                    )
                ;";
            }
        }
    }

    public static function mostrarItens($itemsArray)
    {
        if (!empty($itemsArray)) {
            foreach ($itemsArray as $item) {
                echo "
                    <div title='" . $item['descricao'] . "' class='item'>
                        <img class='item-img' src='" . $item['image_src'] . "'>
                        <p class='item-name'>" . $item['nome'] . "</p>
                        <section class='botoes-manipulacao-input'>
                            <button id='add-" . $item['id'] . "' class='add'>+</button>
                            <input type='number' id='input-" . $item['id'] . "' value='" . $item['quantidade'] . "'>
                            <button id='remove-" . $item['id'] . "' class='remove'>-</button>
                        </section>
                        <button id='item-" . $item['id'] . "' class='botao-comprar'>Comprar R$
                            <p id='item-price-" . $item['id'] . "' class='item-price'>" . $item['preco'] . "</p>
                        </button>
                    </div>
                ";
            }
        } else {
            echo "
                <div class='item'>
                    <p>Não há itens disponíveis no momento...</p>
                </div>
            ";
        }
    }

    public static function importShopJs()
    {
        $jsSourceUrlArray = [
            'js/Shop/Item.js',
            'js/Shop/items/ClickValue.js',
            'js/Shop/items/Multiplier.js',
            'js/Shop/items/Minions.js',
            'js/util/formatadorNums.js',
            'js/Notificacao.js',
            'js/Shop/shop.js'
        ];

        foreach ($jsSourceUrlArray as $srcUrl) {
            echo "<script lang='JavaScript' src='$srcUrl'></script>";
        }
    }
}
