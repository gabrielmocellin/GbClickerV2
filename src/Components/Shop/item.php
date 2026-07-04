<?php
    $isLocked = $userLevel < $minimumLevel;
    $lockedClass = $isLocked ? 'locked' : '';
    $buttonText = $isLocked ? 'Bloqueado' : "Comprar R$ <p class='item-price'></p>";
?>
<div title='<?= $descricao ?>' class='item <?= $lockedClass ?>'>
    <img class='item-img' src='<?= $imageSrc ?>'>
    <p class='item-name'><?= $nome ?></p>
    <?php if ($minimumLevel > 1): ?>
        <p class='item-level-req'>Nível Mínimo: <?= $minimumLevel ?></p>
    <?php endif; ?>
    <section class='botoes-manipulacao-input'>
        <button class='add' <?= $isLocked ? 'disabled' : '' ?>>+</button>
        <input name='input-quantidade' type='number' class='input-quantidade' value='<?= $quantidade ?>' <?= $isLocked ? 'disabled' : '' ?>>
        <button class='remove' <?= $isLocked ? 'disabled' : '' ?>>-</button>
    </section>
    <section class='bulk-buy-options'>
        <button class='bulk-btn bulk-x10' data-amount='10' <?= $isLocked ? 'disabled' : '' ?>>x10</button>
        <button class='bulk-btn bulk-x100' data-amount='100' <?= $isLocked ? 'disabled' : '' ?>>x100</button>
        <button class='bulk-btn bulk-max' data-amount='max' <?= $isLocked ? 'disabled' : '' ?>>MAX</button>
    </section>
    <button class='botao-comprar' <?= $isLocked ? 'disabled' : '' ?>><?= $buttonText ?></button>
    <iteminfo style='display:none'>
        <input type='number' class='input-preco-unitario' value='<?= $preco ?>'>
        <input name='preco-total' type='number' class='input-preco-total' value='<?= $preco ?>'>
        <input name='id-item' class='id-item' type='number' value='<?= $id ?>'>
    </iteminfo>
</div>
