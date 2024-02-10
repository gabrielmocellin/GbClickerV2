<?php
    /** @var GbClicker\Model\UserModel $model */
    use GbClicker\Controller\ShopController;  
?><div id="shop-div">
    <?php ShopController::mostrarItens($itemsArray); ?>
</div>