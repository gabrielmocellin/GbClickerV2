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
        <input style='display:none' type='number' class='input-preco-unitario' value='<?= $preco ?>'>
        <input name='preco-total' style='display:none' type='number' class='input-preco-total' value='<?= $preco ?>'>
        <input name='id-item' style='display:none' type='number' value='<?= $id ?>'>
    </button>
</div>