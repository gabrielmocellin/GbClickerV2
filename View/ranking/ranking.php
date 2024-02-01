<?php
    use GbClicker\Controller\RankingController;
?><div id='admin'>
    <div class='top'>
            <h1 class='boas_vindas'>TOP 10 Magnatas</h1>
    </div>
    <div class='header'>
        <p>Rank</p>
        <p>Foto</p>
        <p>R$</p>
        <p>V.Clique</p>
        <p>Mult</p>
        <p>Minions</p>
    </div>
    <?php RankingController::showUsers(); ?>
</div>