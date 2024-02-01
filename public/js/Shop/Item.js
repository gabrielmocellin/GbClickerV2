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

        this.porcentagem     = 1.03;
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
        let preco = this.calcularPreco(this.quantidade);
        if (gioco.usuario.getDinheiro() < preco) {
            alert(`Dinheiro insuficiente para ${this.nome} x${this.quantidade}! Preço:${preco}`);
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
        const QUANTIDADE_ANTERIOR = this.quantidade;

        let elementoHTMLPpreco = this.precoP;
        let valorInputQuantidade = parseInt(this.quantidadeInput.value);
        let novaQuantidade = valorInputQuantidade;

        if (this.validarNovaQuantidade(novaQuantidade)) {
            let novoPreco = this.calcularPreco(novaQuantidade);

            if (novoPreco < UM_DECILHAO) {
                this.quantidade = novaQuantidade;
                elementoHTMLPpreco.innerText = formatador(novoPreco, 1);
                return;
            }
        }
        // Caso valor inválido (< 10**33 ou NaN ou < 1):
        this.quantidadeInput.value = QUANTIDADE_ANTERIOR;
        elementoHTMLPpreco.innerText = formatador(this.calcularPreco(QUANTIDADE_ANTERIOR), 1);
    }

    calcularPreco(novaQuantidade)
    {
        if (novaQuantidade > 1) {
            // Fórmula Gbex Atualizada: p + (p * n-1) * (t ** n)
            let precoCalculado = this.preco + this.preco * (novaQuantidade-1) * (this.porcentagem)**(novaQuantidade-1);
            return precoCalculado;
        }
        return this.preco;
    }

    validarNovaQuantidade(novaQuantidade)
    {
        if (
            novaQuantidade != NaN &&
            novaQuantidade >= 1
        ) {
            return true;
        };
        return false;
    }

}
