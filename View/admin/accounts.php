<?php
    /** @var GbClicker\Model\UserModel $model */
?><div id='admin'>
    <div class='top'>
        <h1 class='boas_vindas'>Gerenciar Contas</h1>
        <form method='GET' action='/admin/accounts' class='search-bar'>
            <input type='text' name='search' placeholder='Buscar por Email ou Nickname' value='<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES) ?>'>
            <button type='submit' class='botao-acoes blue'>Buscar</button>
            <?php if (!empty($_GET['search'])): ?>
                <a href='/admin/accounts' class='botao-acoes red'>Limpar</a>
            <?php endif; ?>
        </form>
    </div>
    <div class='table-wrapper'>
        <div class='table-container'>
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
            <?php $this->showUsers(); ?>
        </div>
    </div>
    <?php $this->showPagination(); ?>
</div>
