<?php
    if(!empty($itemsArray)):
        echo "<tr>";
        $itemsInTr = 0;
        foreach($itemsArray as $item):
            $itemsInTr++;
            echo "
            <td id='item-".$item['id']."' title='". $item['descricao'] ."'>
                <div>
                    <img class='item-img' src='".$item['image_src']."'>
                    <p class='item-name'>".   $item['nome'] .       "</p>
                    <p>".   $item['quantidade'] . "x</p>
                    <p class='item-price'>R$ ". $item['preco'] .      "</p>
                </div>
            </td>
            ";
            if($itemsInTr >= 4){
                echo "</tr><tr>";
                $itemsInTr = 0;
            }
        endforeach;
    else:
echo "
<td>
    <p>Não há itens disponíveis no momento...</p>
</td>
";
endif;
?>