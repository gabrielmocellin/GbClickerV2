        <div id='admin'>
            <div class='top'>
                <h1 class='boas_vindas'>Criação de itens</h1>
            </div>
            <form action="items/save" method="POST" enctype="multipart/form-data" class='bottom'>
                <label for="nome">Nome:<input type="text" name="nome" id="nome" required></label>
                <label for="descricao">Descrição:<input name="descricao" id="descricao" required></input></label>
                <label for="preco">Preço:<input type="text" name="preco" id="preco" required></label>
                <label for="minimum_level">Nível:<input type="text" name="minimum_level" id="minimum_level" required></label>
                <label for="efeito_valor">Efeito (valor por unidade):<input type="number" name="efeito_valor" id="efeito_valor" min="1" value="1" required></label>
                <label for="tipo">Tipo:
                    <?php if (!empty($tipos)) { ?>
                        <select name="tipo">
                            <?php foreach ($tipos as $tipo): ?>
                                <option value='<?= $tipo['id'] ?>'><?= $tipo['efeito'] ?></option>
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

        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            const erros = {
                1: 'Erro ao salvar item no banco de dados!',
                2: 'Erro ao processar imagem!',
                7: 'Erro ao mover arquivo de imagem no servidor!',
                100: 'Item criado com sucesso!'
            };
            
            if (typeof miniNotificacao !== 'undefined') {
                const mini = new miniNotificacao(erros);
                
                if (params.has('erroImagem')) {
                    mini.criarNotificacao(parseInt(params.get('erroImagem')), true);
                } else if (params.has('erro')) {
                    mini.criarNotificacao(parseInt(params.get('erro')), true);
                } else if (params.has('sucesso')) {
                    mini.criarNotificacao(100, false);
                }
            }
        });
    </script>