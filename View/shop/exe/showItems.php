<?php
    if(!empty($itemsArray)):
        foreach($itemsArray as $item):
echo "
<td id='item-".$item['id']."' title='". $item['descricao'] ."'>
    <div>
        <img class='item-img' src=".$item['image_src'].">
        <p>".   $item['nome'] .       "</p>
        <p>".   $item['quantidade'] . "x</p>
        <p>R$". $item['preco'] .      "</p>
    </div>
</td>
";
    endforeach;
    else:
echo "
<td>
    <p>Não há itens disponíveis no momento...</p>
</td>
";
endif;
?>