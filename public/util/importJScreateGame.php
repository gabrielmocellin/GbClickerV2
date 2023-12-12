<script language="JavaScript" src="js/GerenciadorHeader.js"></script>
<script language="JavaScript" src="js/User.js"></script>
<script language="JavaScript" src="js/Gioco.js"></script>
<script language="JavaScript">
  var gerenciadorDoHeader = new GerenciadorHeader();
  var gioco = new Gioco(
    valorDoClique = <?= $model->getClickValue(); ?>,
    dinheiro = <?= $model->getMoney(); ?>,
    multiplicador = <?= $model->getMultiplier(); ?>,
    minions = <?= $model->getMinions(); ?>,
    nivel = <?= $model->getLevelData()->level; ?>,
    pontosAtuaisDeNivel = <?= $model->getLevelData()->xp_points; ?>,
    pontosNecessariosParaSubirDeNivel = <?= $model->getLevelData()->max_to_up; ?>
  );
</script>
