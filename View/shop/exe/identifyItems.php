<?php if(!empty($itemsArray)): 
         foreach($itemsArray as $item):
            echo "itensArray.push( new " . $item['tipo'] . "(" . $item['id'] . ", " . $item['preco'] . ", " . $item['minimum_level'] . ", " . $item['quantidade'] . ", '" . $item['nome'] . "') );";
         endforeach;
      endif;
?>