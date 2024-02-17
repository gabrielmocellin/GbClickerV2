<div title='<?= $descricao ?>' class='item'>
    <img class='item-img' src='<?= $imageSrc ?>'>
    <p class='item-name'><?= $nome ?></p>
    <section class='botoes-manipulacao-input'>
        <button id='add' class='add'>+</button>
        <input name='input-quantidade' type='number' class='input-quantidade' value='<?= $quantidade ?>'>
        <button id='remove' class='remove'>-</button>
    </section>
    <button class='botao-comprar'>Comprar R$
        <p class='item-price'></p>
    </button>
    <iteminfo style='display:none'>
        <input type='number' class='input-preco-unitario' value='<?= $preco ?>'>
        <input name='preco-total' type='number' class='input-preco-total' value='<?= $preco ?>'>
        <input name='id-item' class='id-item' type='number' value='<?= $id ?>'>
    </iteminfo>
</div>