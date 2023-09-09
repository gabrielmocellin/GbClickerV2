<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN | Criando item</title>
</head>
<body>
    <form action="/insert" enctype="multipart/form-data">
        <label for="item-name-input">Nome do item:</label>
        <input id="item-name-input" name="item-name-input" type='text'>
        <br>
        <label for="item-value-input">Valor do item:</label>
        <input id="item-value-input" name="item-value-input" type='number'>
        <br>
        <label for="item-image-input"><b>Select Image</b></label>
        <input style="display:none;" id="item-image-input" name="item-image-input" type="file" accept="image/png, image/jpeg">
        <h1>Image preview: </h1>
        <img id="item-image-preview" style="max-height:360px; width:720px;" src="" title="Visualização da imagem">
        <br>
        <button type="submit">Salvar Item</button>
    </form>
    <script>
        const imageInput = document.getElementById("item-image-input");
        const imagePreview = document.getElementById("item-image-preview");
        imageInput.addEventListener( "change", () => imagePreview.src = URL.createObjectURL(imageInput.files[0]) )
    </script>
</body>
</html>