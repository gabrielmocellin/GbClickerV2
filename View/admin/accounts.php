<?php
    /** @var GbClicker\Model\UserModel $model */
    use GbClicker\Controller\AccountsController;
?><div id='admin'>
    <div class='top'>
        <h1 class='boas_vindas'>Gerenciar Contas</h1>
    </div>
    <div class='header'>
        <p>ID</p>
        <p>Email</p>
        <p>Nickname</p>
        <p>Foto</p>
        <p>R$</p>
        <p>Valor p/Clique</p>
        <p>Multiplicador</p>
        <p>Minions</p>
        <p>Ações</p>
    </div>
    <?php AccountsController::showUsers(); ?>
    <section class='seletor-paginas'>
        <a href='/admin/accounts?page=1'>1</a>
        <a href='/admin/accounts?page=2'>2</a>
        <a href='/admin/accounts?page=3'>3</a>
        <a href='/admin/accounts?page=4'>4</a>
        <a href='/admin/accounts?page=5'>5</a>
        <a href='/admin/accounts?page=6'>6</a>
        <a href='/admin/accounts?page=7'>7</a>
        <a href='/admin/accounts?page=8'>8</a>
        <a href='/admin/accounts?page=9'>9</a>
        <a>...</a>
    </section>
</div>
