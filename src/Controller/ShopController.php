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
        if ($model != null) {
            $itemsArray = ShopController::pegarItens();
            include_once __DIR__ . '/../../View/shop/shop.php';
        } else {
            header("location: \\login?aviso=1");
        }
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
        echo"
        <script lang='JavaScript' src='js/Shop/Item.js'></script>
        <script lang='JavaScript' src='js/Shop/items/Minions.js'></script>
        <script lang='JavaScript' src='js/Shop/items/Multiplier.js'></script>
        <script lang='JavaScript' src='js/Shop/items/ClickValue.js'></script>
        <script lang='JavaScript' src='js/util/formatadorNums.js'></script>
        ";
    }
}
