<header style='position:relative;'>
    <div class="header_logo_button">
        <div id="hamburguer-navbar-button">
            <img class="menu-icons" src="img/icons/menu.png" alt="Icone abrir/fechar menu">
        </div>
        <a href='/home' id="header_logo" class="noSelect">GbClicker</a>
    </div>
    <div></div>
    <ul class="header_ul_userInfos noSelect">
        <p id="user_money_p" class="user_money noSelect"></p>
        <img id="imagem_perfil" draggable="false" class="user_image noSelect" src="<?=$model->getImageSrc();?>">
    </ul>
    <section id='navbar-conta-dropdown' class="menuClosed">
        <a href="/profile"><img src='img/icons/account.png'>Perfil</a>
        <a href="/config"><img src='img/icons/settings.png'>Configurações</a>
        <a href="/logout"><img src='img/icons/logout.png'>Logout</a>
    </section>
</header>