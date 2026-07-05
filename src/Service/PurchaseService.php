<?php

namespace GbClicker\Service;

use GbClicker\Conexao\Conexao;
use GbClicker\DAO\ItemDAO;
use GbClicker\Model\UserModel;
use GbClicker\DAO\InventarioDAO;
use GbClicker\Model\InventarioModel;

class PurchaseService
{
    public const ERRO_AO_SALVAR_COMPRA = 4;
    public const COMPRA_FINALIZADA = 100;
    public const ERRO_AO_INICIAR_SESSAO = 200;
    public const DINHEIRO_INSUFICIENTE = 0;
    public const ITEM_NOT_FOUND = 4004;

    private const PORCENTAGEM_POR_UNIDADE = 0.03;

    private ItemDAO $itemDao;
    private \GbClicker\DAO\UserDAO $userDao;
    private InventarioDAO $inventarioDao;

    public function __construct(ItemDAO $itemDao, \GbClicker\DAO\UserDAO $userDao)
    {
        $this->itemDao = $itemDao;
        $this->userDao = $userDao;
        $this->inventarioDao = new InventarioDAO();
    }

    /**
     * @return array{resposta:int,mensagem:string}
     */
    public function purchase(string $email, int $itemId, int $quantidade): array
    {
        if ($quantidade < 1 || $quantidade > 1000) {
            return $this->result(self::ERRO_AO_SALVAR_COMPRA, 'Quantidade invalida.');
        }

        $userModel = new UserModel();
        $userModel->setEmail($email);
        
        if (!$userModel->getByEmail()) {
            return $this->result(self::ERRO_AO_INICIAR_SESSAO, 'Usuario nao encontrado.');
        }

        $itemData = $this->itemDao->selectById($itemId);
        if ($itemData === false || $itemData === null) {
            return $this->result(self::ITEM_NOT_FOUND, 'Item nao encontrado.');
        }

        $precoBase = (int) $itemData['preco'];
        
        // Descobrir quantos itens DESSES o usuário já possui para escalar o preço
        $quantidadeAtual = 0;
        foreach ($userModel->upgradesInfo->getInventario() as $invItem) {
            if ($invItem->getIdItem() == $itemId) {
                $quantidadeAtual = $invItem->getQuantidade();
                break;
            }
        }

        $precoTotal = $this->calcularPrecoTotal(
            $precoBase,
            $quantidade,
            $quantidadeAtual
        );

        $minimumLevel = (int) ($itemData['minimum_level'] ?? 1);
        if ((int) $userModel->getLevel() < $minimumLevel) {
            return $this->result(self::ERRO_AO_SALVAR_COMPRA, 'Nivel insuficiente para comprar este item.');
        }

        if ((int) $userModel->getMoney() < $precoTotal) {
            return $this->result(self::DINHEIRO_INSUFICIENTE, 'Dinheiro insuficiente.');
        }

        // Subtrai dinheiro
        $atualizado = $this->userDao->updateMoney($email, $precoTotal);

        if (!$atualizado) {
            return $this->result(self::ERRO_AO_SALVAR_COMPRA, 'Nao foi possivel concluir a compra.');
        }

        // Adiciona ao inventario
        $invModel = new InventarioModel();
        $invModel->setEmailUsuario($email);
        $invModel->setIdItem($itemId);
        $invModel->setQuantidade($quantidade);
        
        $inseridoNoInventario = $this->inventarioDao->insert($invModel);

        if (!$inseridoNoInventario) {
            // Em um sistema real, faríamos rollback do dinheiro. Para manter simples, retornamos erro
            return $this->result(self::ERRO_AO_SALVAR_COMPRA, 'Erro ao salvar item no inventario.');
        }

        return $this->result(self::COMPRA_FINALIZADA, 'Compra realizada com sucesso.');
    }

    private function calcularPrecoTotal(int $precoBase, int $quantidade, int $quantidadeAtual): int
    {
        $fatorCrescimento = 1 + self::PORCENTAGEM_POR_UNIDADE;
        $quantidadeAtual = max(0, $quantidadeAtual);
        $primeiroTermo = $precoBase * ($fatorCrescimento ** $quantidadeAtual);
        $somaProgressao = (($fatorCrescimento ** $quantidade) - 1) / ($fatorCrescimento - 1);
        $precoTotal = $primeiroTermo * $somaProgressao;

        if (!is_finite($precoTotal)) {
            return PHP_INT_MAX;
        }

        return (int) ceil($precoTotal);
    }

    /**
     * @return array{resposta:int,mensagem:string}
     */
    private function result(int $code, string $message): array
    {
        return [
            'resposta' => $code,
            'mensagem' => $message,
        ];
    }
}
