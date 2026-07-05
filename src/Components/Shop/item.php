<?php
    $isLocked = $userLevel < $minimumLevel;
    $lockedClass = $isLocked ? 'locked' : '';
    $buttonText = $isLocked ? 'Bloqueado' : "R$ <span class='item-price'></span>";
?>
<div title='<?= $descricao ?>' class='item <?= $lockedClass ?>'>
    <?php if ($isLocked): ?>
        <div class="locked-overlay">
            <i class="fa-solid fa-lock"></i>
            <p class='item-level-req'>Nível Mínimo: <?= $minimumLevel ?></p>
        </div>
    <?php endif; ?>

    <div class='item-header'>
        <div class="img-wrapper">
            <img class='item-img' src='<?= $imageSrc ?>' alt='<?= $nome ?>'>
        </div>
        <h3 class='item-name'><?= $nome ?></h3>
        <p class='item-effect'><?= $efeitoString ?></p>
    </div>

    <div class='item-stats'>
        <div class='stat-box'>
            <span class='stat-label'>Possui</span>
            <span class='stat-value quantity-owned'><?= $quantidadePossuida ?></span>
        </div>
    </div>
    
    <div class='item-actions'>
        <input name='input-quantidade' type='number' class='input-quantidade' value='1' min='1' max='1000' <?= $isLocked ? 'disabled' : '' ?>>
        
        <section class='bulk-buy-options'>
            <button class='bulk-btn bulk-x10' data-amount='10' <?= $isLocked ? 'disabled' : '' ?>>x10</button>
            <button class='bulk-btn bulk-x100' data-amount='100' <?= $isLocked ? 'disabled' : '' ?>>x100</button>
            <button class='bulk-btn bulk-max' data-amount='max' <?= $isLocked ? 'disabled' : '' ?>>MAX</button>
        </section>

        <button class='botao-comprar' <?= $isLocked ? 'disabled' : '' ?>>
            <span class='buy-text'><?= $isLocked ? 'Bloqueado' : 'COMPRAR' ?></span>
            <?php if (!$isLocked): ?>
                <span class='buy-price'><?= $buttonText ?></span>
            <?php endif; ?>
        </button>
    </div>

    <iteminfo style='display:none'>
        <input type='number' class='input-preco-unitario' value='<?= $preco ?>'>
        <input name='preco-total' type='number' class='input-preco-total' value='<?= $preco ?>'>
        <input name='id-item' class='id-item' type='number' value='<?= $id ?>'>
    </iteminfo>
</div>
