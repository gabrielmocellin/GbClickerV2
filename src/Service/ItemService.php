<?php

namespace GbClicker\Service;

use GbClicker\DAO\ItemDAO;
use GbClicker\Model\ItemModel;

class ItemService
{
    private ItemDAO $itemDao;

    public function __construct(ItemDAO $itemDao)
    {
        $this->itemDao = $itemDao;
    }

    public function findById(int $id): ?ItemModel
    {
        $itemData = $this->itemDao->selectById($id);
        if ($itemData) {
            $item = new ItemModel();
            $item->fillItemModel($itemData);
            return $item;
        }
        return null;
    }

    public function findAll(): array
    {
        $itemsData = $this->itemDao->select();
        $items = [];
        foreach ($itemsData as $itemData) {
            $item = new ItemModel();
            $item->fillItemModel($itemData);
            $items[] = $item;
        }
        return $items;
    }

    public function findAllTypes(): array
    {
        return $this->itemDao->selectAllItemTypes();
    }

    public function save(ItemModel $model): bool
    {
        return $this->itemDao->insert($model);
    }
}
