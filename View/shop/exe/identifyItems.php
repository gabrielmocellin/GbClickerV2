<?php if(!empty($itemsArray)): foreach($itemsArray as $item):
     if($item['tipo']     == "Multiplier"):
        echo "itensArray.push( new Multiplier(" . $item['id'] . ", " . $item['preco'] . ", " . $item['minimum_level'] . ", " . $item['quantidade'] . ") );";
     elseif($item['tipo'] == "Minion"): 
        echo "itensArray.push( new Minion("     . $item['id'] . ", " . $item['preco'] . ", " . $item['minimum_level'] . ", " . $item['quantidade'] . ") );";
     elseif($item['tipo'] == "ClickValue"): 
        echo "itensArray.push( new ClickValue(" . $item['id'] . ", " . $item['preco'] . ", " . $item['minimum_level'] . ", " . $item['quantidade'] . ") );";
endif; endforeach; endif;
?>