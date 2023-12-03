<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/item.css"></link>
    <title>ADMIN | Itens</title>
    
</head>
<body>
    <form action="items/save" method="POST" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
        <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" required></textarea>
        <label for="preco">Preço:</label>
            <input type="text" name="preco" id="preco" required>
        <label for="minimum_level">Nível Mínimo:</label>
            <input type="text" name="minimum_level" id="minimum_level" required>
        <label for="quantidade">Quantidade:</label>
            <input type="text" name="quantidade" id="quantidade" required>
        <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" id="tipo" required>
        <label for="image_src">Imagem (PNG ou JPG):</label>  <input type="file" name="image_src" id="image_src" accept=".png, .jpg, .jpeg" onchange="previewImage(this)" required>

        <img id="preview" class="preview" alt="Preview">

        <input type="submit" value="Enviar">
    </form>

    <script>
        function previewImage(input) {
            let preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(input.files[0]);
        }
    </script>
</body>
</html>