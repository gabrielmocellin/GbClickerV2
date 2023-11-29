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

    public static function mostrarItens($itemsArray)
    {
        if (!empty($itemsArray)) {
            echo "<tr>";
            $itemsInTr = 0;
            foreach ($itemsArray as $item) {
                $itemsInTr++;
                echo "
                    <td id='item-" . $item['id'] . "' title='" . $item['descricao'] . "'>
                        <div>
                            <img class='item-img' src='" . $item['image_src'] . "'>
                            <p class='item-name'>" . $item['nome'] . "</p>
                            <p>" . $item['quantidade'] . "x</p>
                            <p class='item-price'>R$ " . $item['preco'] . "</p>
                        </div>
                    </td>
                ";
                if ($itemsInTr >= 4) {
                    echo "</tr><tr>";
                    $itemsInTr = 0;
                }
            }
        } else {
            echo "
                <td>
                    <p>Não há itens disponíveis no momento...</p>
                </td>
            ";
        }
    }

    public static function identificarItens($itemsArray)
    {
        if (!empty($itemsArray)) {
            foreach ($itemsArray as $item) {
                echo "itensArray.push(new " . $item['tipo'] . "(" . $item['id'] . ", "
                . $item['preco'] . ", " . $item['minimum_level'] . ", "
                . $item['quantidade'] . ", '" . $item['nome'] . "') );
                ";
            }
        }
    }
}
