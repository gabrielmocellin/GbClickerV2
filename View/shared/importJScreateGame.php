    <script language="JavaScript" src="View/shared/js/navbar.js"></script>
    <script language="JavaScript" src="View/shared/js/User.js"></script>
    <script language="JavaScript" src="View/shared/js/game.js"></script>
    <script language="JavaScript">
        var jogo = new game(
          valorDoClique                     = <?= $model->getClickValue(); ?>,
          dinheiro                          = <?= $model->getMoney(); ?>,
          multiplicador                     = <?= $model->getMultiplier(); ?>,
          minions                           = <?= $model->getMinions(); ?>,
          nivel                             = <?= $model->getLevelData()->level; ?>,
          pontosAtuaisDeNivel               = <?= $model->getLevelData()->xp_points; ?>,
          pontosNecessariosParaSubirDeNivel = <?= $model->getLevelData()->max_to_up; ?>
        );
    </script>