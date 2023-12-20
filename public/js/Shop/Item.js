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
        this.porcentagem     = 0.05;
        this.iniciarEventListener();
    }

    iniciarEventListener()
    {
        this.compraBotao.addEventListener(
            'click',
            this.comprar.bind(this)
        );

        this.quantidadeInput.addEventListener(
            'change',
            this.atualizarQuantidade.bind(this)
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
