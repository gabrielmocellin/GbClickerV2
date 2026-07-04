        <div id='admin'>
            <div class='top'>
                <h1 class='boas_vindas'>Criação de itens</h1>
            </div>
            <form action="items/save" method="POST" enctype="multipart/form-data" class='bottom'>
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
                
                <img id="preview" class="preview" alt="Preview" src='../img/icons/account.png'>
                <input class="botao_enviar" type="submit" value="Enviar">
            </form>
        </div>
    <script>
        function previewImage(input) {
            let preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(input.files[0]);
        }
    </script>