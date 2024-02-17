function montarArrayItens() {
    let itensArray = document.querySelectorAll('.item');
    let isArrayVazia = itensArray.length == 0;

    if (isArrayVazia) {
        mini.criarNotificacao(1, true);
        itensArray = null;
    }

    return itensArray;
}

/* -=-=-= { Validações } =-=-=- */
function validarQuantidade(quantidade) {
    const QUANTIDADE_MAX = 1000;
    let valorAbsoluto = Math.abs(quantidade);

    let isValid = (quantidade != NaN && quantidade >= 1 && valorAbsoluto < QUANTIDADE_MAX);

    return isValid;
}

/* -=-=-= { EventListener's } =-=-=- */
function adicionarEventListeners(itensArray) {
    if (itensArray == null) {
        return false;
    }

    itensArray.forEach((item) => {
        ativarEventListenerInput(item);
        atualizarQuantidade(item, 1);
        ativarEventListenerCompra(item);
    })
}

function ativarEventListenerCompra(item) {
    let botaoComprar = item.querySelector('.botao-comprar');
    botaoComprar.addEventListener(
        'click',
        () => comprar(item)
    )
}

function ativarEventListenerInput(item) {
    let inputQuantidade = item.querySelector('.input-quantidade');

    inputQuantidade.addEventListener(
        'change',
        () => atualizarQuantidade(item, pegarQuantidadeInput(inputQuantidade))
    );
}

function pegarQuantidadeInput(input) {
    return parseInt(input.value);
}

function atualizarQuantidade(item, novaQuantidade) {
    const UNIDADE = 1;
    let inputQuantidade = item.querySelector('.input-quantidade');
    let inputPrecoTotal = item.querySelector('.input-preco-total');
    let pItemPrice = item.querySelector('.item-price');
    let preco = calcularPreco(item, novaQuantidade);

    if (validarQuantidade(novaQuantidade)) {
        pItemPrice.innerText = preco;
        inputPrecoTotal.value = preco;
        return true;
    }

    preco = calcularPreco(item, UNIDADE);
    inputQuantidade.value = UNIDADE;
    pItemPrice.innerText = preco;
    inputPrecoTotal.value = preco;
    
    mini.criarNotificacao(3, true);
    return false;
}

function calcularPreco(item, novaQuantidade) {
    const PORCENTAGEM_POR_UNIDADE = 0.03;
    const PRECO_UNITARIO_INPUT = item.querySelector('.input-preco-unitario');
    let precoUnitario = parseInt(PRECO_UNITARIO_INPUT.value);
    let precoCalculado = precoUnitario;

    for (let i = 1; i < novaQuantidade; i++) {
        precoUnitario += precoUnitario * PORCENTAGEM_POR_UNIDADE;
        precoCalculado += precoUnitario;
    }
    
    return parseInt(precoCalculado);
}

function comprar(item) {
    const DINHEIRO_INSUFICIENTE = 0;
    const COMPRA_REALIZADA = 100;

    let precoTotal = parseInt(item.querySelector('.input-preco-total').value);
    let dinheiroInsuficiente = gioco.usuario.dinheiro < precoTotal;
    let quantidade = parseInt(item.querySelector('.input-quantidade').value);
    let itemId = parseInt(item.querySelector('.id-item').value);

    if (dinheiroInsuficiente) {
        mini.criarNotificacao(DINHEIRO_INSUFICIENTE, true);
        return;
    }

    gioco.usuario.dinheiro -= precoTotal;
    gioco.salvarDinheiro();
    gioco.salvarItem(itemId, quantidade);

    mini.criarNotificacao(COMPRA_REALIZADA, false);

    return;
}

window.onload = () => formatarNumerosNasDivs('p.item-price', 1);

const erros = {
    0: 'Dinheiro insuficiente!',
    1: 'Sem itens disponíveis!',
    2: 'Erro ao atualizar preco!',
    3: 'Apenas quantidade entre: 1, 1000!',
    4: 'Erro ao salvar compra!',
    100: 'Compra realizada com sucesso!',
    201 : "Erro ao iniciar sessão!"
};

var mini = new miniNotificacao(erros);
let itensArray = montarArrayItens();
adicionarEventListeners(itensArray);


/*
function calcularPreco2(item, novaQuantidade) {
    const PORCENTAGEM_POR_UNIDADE = 1.03;
    const QUANTIDADE_ADICIONADA   = (novaQuantidade - 1);
    let precoUnitarioInput = item.querySelector('.input-preco-unitario');
    let precoUnitario = parseInt(precoUnitarioInput.value);

    if (novaQuantidade === 1) {
        return parseInt(precoUnitario);
    }

    let precoCalculado = precoUnitario + (precoUnitario * QUANTIDADE_ADICIONADA) * (PORCENTAGEM_POR_UNIDADE ** QUANTIDADE_ADICIONADA);
    return parseInt(precoCalculado);
}
*/