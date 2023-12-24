<div id="div-menu-navbar" class="menuClosed">
    <ul class="navbar">
        <li onclick="gerenciadorDoHeader.RedirectPage(1)">
            <img draggable="false" src="<?= $GLOBALS['prefix'] ?>img/icons/click.png" alt="Página Inicial">
            Página Inicial
        </li>
        <?php
            if ($model->getTipoConta() === "ADMIN") {
        ?>
        <li onclick="gerenciadorDoHeader.RedirectPage(101)">
            <img draggable="false" src="<?= $GLOBALS['prefix'] ?>img/icons/maintenance.png" alt="Admin">
            Admin
        </li>
        <?php
            }
        ?>
        <li onclick="gerenciadorDoHeader.RedirectPage(2)">
            <img draggable="false" src="<?= $GLOBALS['prefix'] ?>img/icons/shopping_cart.png" alt="Loja">
            Loja
        </li>
        <li onclick="gerenciadorDoHeader.RedirectPage(4)">
            <img draggable="false" src="<?= $GLOBALS['prefix'] ?>img/icons/trophy.png" alt="Ranking">
            Ranking
        </li>
        <li class='disabled'>
            <img draggable="false" src="<?= $GLOBALS['prefix'] ?>img/icons/inventory.png" alt="Inventário">
            Inventário
        </li>
        <li class="disabled">
            <img draggable="false" src="<?= $GLOBALS['prefix'] ?>img/icons/machines.png" alt="Máquinas em manutenção">
            Máquinas
        </li>
        <li class="disabled">
            <img draggable="false" src="<?= $GLOBALS['prefix'] ?>img/icons/maintenance.png" alt="Em breve">
            Em breve...
        </li>
    </ul>
</div>