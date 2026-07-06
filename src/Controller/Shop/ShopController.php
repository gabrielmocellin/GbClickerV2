<?php

namespace GbClicker\Controller\Shop;

use GbClicker\Model\UserModel;
use GbClicker\Controller\Auth\LoginController;
use GbClicker\Service\ItemService;

class ShopController
{

    private LoginController $loginController;
    private ItemService $itemService;

    public function __construct(LoginController $loginController, ItemService $itemService)
    {
        $this->loginController = $loginController;
        $this->itemService = $itemService;
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
        // Precisamos retornar array pois a view espera array
        $items = $this->itemService->findAll();
        $itemsArray = [];
        foreach ($items as $item) {
            $itemsArray[] = [
                'id' => $item->getId(),
                'descricao' => $item->getDescricao(),
                'image_src' => $item->getImageSrc(),
                'nome' => $item->getNome(),
                'efeito_valor' => $item->getEfeitoValor(),
                'preco' => $item->getPreco(),
                'minimum_level' => $item->getMinimumLevel(),
                'efeito' => $item->getEfeito()
            ];
        }
        return $itemsArray;
    }

    public function mostrarItens($itemsArray, UserModel $userModel = null)
    {
        $userLevel = $userModel ? $userModel->getLevel() : 0;
        $inventario = $userModel ? $userModel->upgradesInfo->getInventario() : [];
        
        if (!empty($itemsArray)) {
            foreach ($itemsArray as $item) {
                $id = $item['id'];
                $descricao = $item['descricao'];
                $imageSrc = $item['image_src'];
                $nome = $item['nome'];
                $efeito_valor = $item['efeito_valor'];
                $preco = $item['preco'];
                $minimumLevel = $item['minimum_level'] ?? 1;
                
                $efeitoString = "+{$efeito_valor}";
                if (isset($item['efeito'])) {
                    if ($item['efeito'] == 'clickValue') {
                        $efeitoString = "+{$efeito_valor} por Clique";
                    } elseif ($item['efeito'] == 'minion') {
                        $efeitoString = "+{$efeito_valor}/s (Automático)";
                    } elseif ($item['efeito'] == 'multiplier') {
                        $efeitoString = "+{$efeito_valor} Multiplicador Global";
                    } else {
                        $efeitoString = "+{$efeito_valor} {$item['efeito']}";
                    }
                }
                
                $quantidadePossuida = 0;
                foreach ($inventario as $invItem) {
                    if ($invItem->getIdItem() == $id) {
                        $quantidadePossuida = $invItem->getQuantidade();
                        break;
                    }
                }

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
