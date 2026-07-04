<?php
    /** @var GbClicker\Model\UserModel $model */
    use GbClicker\Controller\ShopController;  
?><div id="shop-div">
    <?php $this->mostrarItens($itemsArray, $model->getLevel()); ?>
</div>