<?php
    /**
     * @var \GbClicker\Model\UserModel $model
     */
?>        <div id='admin'>
            <div class='top'>
                <h1 class='boas_vindas'>Bem-vindo, <?= $model->getNickname(); ?>!</h1>
            </div>
            <div class='bottom'>
                <a href='admin/accounts'>
                    <img src='img/icons/account.png'>
                    <h1>Contas</h1>
                </a>
                <a href='admin/items'>
                    <img src='img/icons/add_item.png'>
                    <h1>Itens</h1>
                </a>
                <a href='#' class='disabled'>
                    <img src='img/icons/ticket.png'>
                    <h1>Códigos</h1>
                </a>
                <a href='#' class='disabled'>
                    <img src='img/icons/machines.png'>
                    <h1>Máquinas</h1>
                </a>
                <a href='#' class='disabled'>
                    <img src='img/icons/maintenance.png'>
                    <h1>Minions</h1>
                </a>
                <a href='#' class='disabled'>
                    <img src='img/icons/maintenance.png'>
                    <h1>Minions</h1>
                </a>
            </div>
        </div>