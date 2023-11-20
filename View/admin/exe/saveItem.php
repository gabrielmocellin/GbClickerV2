<?php
    if (isset($_FILES['image_src'])) {
        $saveDir = 'View/uploads/items/';
        $name = basename($_FILES['image_src']['name']);
        $path = $saveDir . basename($_FILES['image_src']['name']);

        if (move_uploaded_file($_FILES['image_src']['tmp_name'], $path)) { // Pegando o arquivo que está temporário e salvando em uma pasta dentro do projeto
            $dirFile = "View/uploads/items/" . $name;

            $item = new ItemModel();
            $item->construtor($_POST['nome'], $_POST['descricao'], $_POST['preco'], $_POST['minimum_level'], $_POST['quantidade'], $dirFile, $_POST['tipo']);
            if($item->save()) header('location: /items');
        }
    }
    