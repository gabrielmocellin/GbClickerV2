<script lang='JavaScript' src='<?= $GLOBALS['prefix'] ?>js/GerenciadorHeader.js'></script>
<script lang='JavaScript' src='<?= $GLOBALS['prefix'] ?>js/User.js'></script>
<script lang='JavaScript' src='<?= $GLOBALS['prefix'] ?>js/Gioco.js'></script>
<script lang='JavaScript' src='<?= $GLOBALS['prefix'] ?>js/util/miniNotificacao.js'></script>
<script lang='JavaScript' src='<?= $GLOBALS['prefix'] ?>js/util/formatadorNums.js'></script>
<script lang='JavaScript'>
  var gerenciadorDoHeader = new GerenciadorHeader();
  var gioco = new Gioco(
    valorDoClique                     = <?= $model->getClickValue(); ?>,
    dinheiro                          = <?= $model->getMoney(); ?>,
    multiplicador                     = <?= $model->getMultiplier(); ?>,
    minions                           = <?= $model->getMinions(); ?>,
    nivel                             = <?= $model->getLevelData()->level; ?>,
    pontosAtuaisDeNivel               = <?= $model->getLevelData()->xp_points; ?>,
    pontosNecessariosParaSubirDeNivel = <?= $model->getLevelData()->max_to_up; ?>
  );
</script>
