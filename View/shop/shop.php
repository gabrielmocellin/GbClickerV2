<?php
    /** 
     * @var GbClicker\Model\UserModel $model 
     * @var array $itemsArray */
    use GbClicker\Controller\Shop\ShopController;  
?><div id="shop-div">
    <?php $this->mostrarItens($itemsArray, $model); ?>
</div>