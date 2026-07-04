<?php

namespace GbClicker\Controller;

use GbClicker\Model\{
    UserModel,
    ItemModel
};

class ShopController
{

    private LoginController $loginController;

    public function __construct(LoginController $loginController)
    {
        $this->loginController = $loginController;
    }
    public function index()
    {
        $model = $this->loginController->login();
        
        if ($model == null) {
            header("location: /login?aviso=1", true);
            exit;
        }

        $itemsArray = $this->pegarItens();
        $titulo = 'Shop';

        $linksCss = [
            'css/shop.css'
        ];

        $srcJs = [
            'js/util/formatadorNums.js',
            'js/Shop/shop.js'
        ];

        $conteudoMain = '../View/shop/shop.php';

        require_once '../src/Components/template.php';
    }

    public function pegarItens()
    {
        $itemModel = new ItemModel();
        $itemsArray = $itemModel->getAllItems();
        return $itemsArray;
    }

    public function mostrarItens($itemsArray, $userLevel = 0)
    {
        if (!empty($itemsArray)) {
            foreach ($itemsArray as $item) {
                $id = $item['id'];
                $descricao = $item['descricao'];
                $imageSrc = $item['image_src'];
                $nome = $item['nome'];
                $quantidade = $item['quantidade'];
                $preco = $item['preco'];
                $minimumLevel = $item['minimum_level'] ?? 1;

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
