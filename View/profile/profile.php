<?php
    /** @var GbClicker\Model\UserModel $model */
?><div id='profile'>
    <div class='top'>
        <img src='<?= $profile->getImageSrc(); ?>'>
        <section>
            <h1 class='profile-nickname'>@<?= $profile->getNickname(); ?></h1>
            <h1 class='profile-rank'>TOP #<?= $profile->getRank(); ?> Dinheiro</h1>
        </section>
    </div>
    <div class='bottom'>
        <section>
            <h1><?= $profile->getLevel(); ?></h1>
            <p>Nível</p>
        </section>
        <section>
            <h1><?= $profile->getClickValue(); ?></h1>
            <p>Valor P/ Clique</p>
        </section>
        <section>
            <h1><?= $profile->getMultiplier(); ?></h1>
            <p>Multiplicador</p>
        </section>
        <section>
            <h1><?= $profile->getMoney(); ?></h1>
            <p>Dinheiro</p>
        </section>
        <section>
            <h1><?= $profile->getMinions(); ?></h1>
            <p>Minions</p>
        </section>
    </div>
</div>