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
        include_once __DIR__ . '/../../View/shop/newShop.php';
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
                echo "itensArray.push(new " . $item['classificacao'] . "(" . $item['id'] . ", "
                . $item['preco'] . ", " . $item['minimum_level'] . ", "
                . $item['quantidade'] . ", '" . $item['nome'] . "') );
                ";
            }
        }
    }

    public static function novoMostrarItens($itemsArray)
    {
        if (!empty($itemsArray)) {
            foreach ($itemsArray as $item) {
                echo "
                    <div title='" . $item['descricao'] . "' class='item'>
                        <img class='item-img' src='" . $item['image_src'] . "'>
                        <p class='item-name'>" . $item['nome'] . "</p>
                        <section class='botoes-manipulacao-input'><button class='add'>+</button><input type='text' value='" . $item['quantidade'] . "'><button class='remove'>-</button></section>
                        <button id='item-" . $item['id'] . "' class='botao-comprar'>Comprar R$<p class='item-price'>" . $item['preco'] . "</p></button>
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
}
