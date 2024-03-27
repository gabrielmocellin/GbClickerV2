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

    let isValid = (
        quantidade != NaN &&
        quantidade >= 1 &&
        valorAbsoluto < QUANTIDADE_MAX
    );

    return isValid;
}

/* -=-=-= { EventListener's } =-=-=- */
function adicionarEventListeners(itensArray) {
    if (itensArray == null) {
        return false;
    }

    itensArray.forEach(async (item) => {
        ativarEventListenerInput(item);
        await atualizarQuantidade(item, 1);
        ativarEventListenerCompra(item);
    });
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

async function atualizarQuantidade(item, novaQuantidade) {
    let inputQuantidade = item.querySelector('.input-quantidade');
    let inputPrecoTotal = item.querySelector('.input-preco-total');
    let pItemPrice = item.querySelector('.item-price');
    let novaQuantidadeValida = validarQuantidade(novaQuantidade);

    if (novaQuantidadeValida) {
        let preco = await calcularPreco(item, novaQuantidade);
        let precoFormatado = formatador(preco, 1); 
        inputPrecoTotal.value = preco;
        pItemPrice.innerText = precoFormatado;

        return true;
    }

    let preco = await calcularPreco(item, 1);
    let precoFormatado = formatador(preco, 1);

    inputQuantidade.value = 1;
    pItemPrice.innerText = precoFormatado;
    inputPrecoTotal.value = preco;
    
    mini.criarNotificacao(3, true);

    return false;
}

async function calcularPreco(item, novaQuantidade) {
    const PORCENTAGEM_POR_UNIDADE = 0.03;
    const PRECO_UNITARIO_INPUT = item.querySelector('.input-preco-unitario');

    let precoUnitarioDoInput = parseInt(PRECO_UNITARIO_INPUT.value);
    let precoUnitario = await calcularPrecoDaProximaUnidade(item, precoUnitarioDoInput);

    precoUnitario = (precoUnitario * novaQuantidade) + (precoUnitario * PORCENTAGEM_POR_UNIDADE * (novaQuantidade - 1));

    return parseInt(precoUnitario);
}

async function calcularPrecoDaProximaUnidade(item, precoUnitario) {
    const PORCENTAGEM_POR_UNIDADE = 0.03;
    let itemId = parseInt(item.querySelector('.id-item').value);
    let quantidadeAtual = await gioco.getUserItemAmount(itemId);

    if (quantidadeAtual === 0) {
        quantidadeAtual = 1;
    }

    precoUnitario = (precoUnitario * quantidadeAtual) + (precoUnitario * PORCENTAGEM_POR_UNIDADE * (quantidadeAtual - 1));

    return precoUnitario;
}

function comprar(item) {
    const DINHEIRO_INSUFICIENTE = 0;

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

    return;
}

const erros = {
    0: 'Dinheiro insuficiente!',
    1: 'Sem itens disponíveis!',
    2: 'Erro ao atualizar preco!',
    3: 'Apenas quantidade entre: 1, 1000!',
    4: 'Erro ao salvar compra!',
    100: 'Compra realizada com sucesso!',
    201: "Erro ao iniciar sessão!",
    4005: "Usuário não encontrado!",
    4004: "Item não encontrado!",
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