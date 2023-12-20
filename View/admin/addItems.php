<?php
    /** @var GbClicker\Model\UserModel $model */
?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel='stylesheet' href='css/site.css'>
    <link rel="stylesheet" href="css/item.css">
    <link rel="stylesheet" href="css/adminpages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Admin | Itens</title>
</head>
<body>
    <?php require_once "util/header.php"; ?>
    <main>
        <?php require_once "util/navbar.php"; ?>
        <div id='admin'>
            <div class='top'>
                <h1 class='boas_vindas'>Criação de itens</h1>
            </div>
            <form action="admin/items/save" method="POST" enctype="multipart/form-data" class='bottom'>
                <label for="nome">Nome:<input type="text" name="nome" id="nome" required></label>
                <label for="descricao">Descrição:<input name="descricao" id="descricao" required></input></label>
                <label for="preco">Preço:<input type="text" name="preco" id="preco" required></label>
                <label for="minimum_level">Nível:<input type="text" name="minimum_level" id="minimum_level" required></label>
                <label for="quantidade">Quantidade:<input type="text" name="quantidade" id="quantidade" required></label>
                <label for="tipo">Tipo:
                    <?php if (!empty($tipos)) { ?>
                        <select name="tipo">
                            <?php foreach ($tipos as $tipo): ?>
                                <option value='<?= $tipo['id'] ?>'><?= $tipo['classificacao'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php } else {echo "Sem Tipos!";}?>
                </label>
                <label for="image_src">Imagem (PNG ou JPG):</label>  <input style='display:none' type="file" name="image_src" id="image_src" accept=".png, .jpg, .jpeg" onchange="previewImage(this)" required>
                
                <img id="preview" class="preview" alt="Preview" src='img/icons/account.png'>
                <input class="botao_enviar" type="submit" value="Enviar">
            </form>
        </div>
    </main>
    <script>
        function previewImage(input) {
            let preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(input.files[0]);
        }
    </script>
    <?php require 'util/importJScreateGame.php'; ?>
</body>
</html>