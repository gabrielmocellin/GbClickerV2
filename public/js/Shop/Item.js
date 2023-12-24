class Item
{
    constructor(
        id,
        preco,
        minimum_level,
        quantidade,
        nome
    )
    {
        this.id              = id;
        this.preco           = preco;
        this.minimum_level   = minimum_level;
        this.quantidade      = quantidade;
        this.nome            = nome;

        this.compraBotao     = document.getElementById(`item-${this.id}`);
        this.quantidadeInput = document.getElementById(`input-${this.id}`);
        this.precoP          = document.getElementById(`item-price-${this.id}`);
        this.addBotao        = document.getElementById(`add-${this.id}`);
        this.removeBotao     = document.getElementById(`remove-${this.id}`);

        this.porcentagem     = 0.05;
        this.iniciarEventListener();
    }

    iniciarEventListener()
    {
        /* Botão para realizar a compra do item */
        this.compraBotao.addEventListener(
            'click',
            this.comprar.bind(this)
        );
        
        /* Input de quantidade do item */
        this.quantidadeInput.addEventListener(
            'change',
            this.atualizarQuantidade.bind(this)
        );

        /* Botão adicionar quantidade */
        this.addBotao .addEventListener(
            'click',
            () => {
                this.gerenciarQuantidade(true);
            }
        );
        
        /* Botão remover quantidade */
        this.removeBotao.addEventListener(
            'click',
            () => {
                this.gerenciarQuantidade(false);
            }
        );
    }

    comprar()
    {
        if (gioco.usuario.getDinheiro() < this.calcularPreco(this.quantidade)) {
            alert(`Dinheiro insuficiente para [${this.nome}] x${this.quantidade}!`);
            return;
        }

        this.add();
        this.cashOut();

        gioco.AtualizarValorNoElemento("user_money_p", gioco.usuario.getDinheiro(), "R$ "); // Atualizando o dinheiro atual do usuário;
    }

    cashOut()
    {
        let dinheiroDescontado = gioco.usuario.getDinheiro() - this.calcularPreco(this.quantidade);
        gioco.usuario.setDinheiro(dinheiroDescontado);
    }

    gerenciarQuantidade(opcao)
    {
        let novaQuantidade = 0;
        if (opcao) {
            novaQuantidade = this.quantidade + 1;
        } else {
            novaQuantidade = this.quantidade - 1;
        }

        if (this.validarNovaQuantidade(novaQuantidade)) {
            this.quantidadeInput.value = novaQuantidade;
            this.atualizarQuantidade();
        }
    }

    atualizarQuantidade()
    {
        const UM_DECILHAO = 10**33;
        let novaQuantidade = parseInt(this.quantidadeInput.value);

        if (this.validarNovaQuantidade(novaQuantidade)) {
            let novoPreco = this.calcularPreco(novaQuantidade);

            if (novoPreco < UM_DECILHAO) {
                this.quantidade = novaQuantidade;
                this.precoP.innerText = formatador(novoPreco, 1);
            } else {
                this.quantidadeInput.value = this.quantidade;
                this.precoP.innerText = formatador(this.calcularPreco(this.quantidade), 1);
            }
        } else {
            // Caso não seja um valor válido (Menor que 1 ou NaN),
            // a quantidade voltará para o último valor válido inserido.
            this.quantidadeInput.value = this.quantidade;
            this.precoP.innerText = formatador(this.calcularPreco(this.quantidade), 1);
        }
    }

    calcularPreco(novaQuantidade)
    {
        if (novaQuantidade > 1) {
            return this.preco * ((1 + this.porcentagem) ** novaQuantidade)
        }
        return this.preco;
    }

    validarNovaQuantidade(novaQuantidade)
    {
        if (novaQuantidade != NaN && novaQuantidade >= 1) {
            return true;
        };
        return false;
    }

}
