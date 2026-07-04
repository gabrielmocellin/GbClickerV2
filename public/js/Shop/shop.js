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
        ativarEventListenerBotoesQuantidade(item);
        ativarEventListenerBulk(item);
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

function ativarEventListenerBotoesQuantidade(item) {
    const inputQuantidade = item.querySelector('.input-quantidade');
    const botaoAdicionar = item.querySelector('.add');
    const botaoRemover = item.querySelector('.remove');

    botaoAdicionar.addEventListener('click', async () => {
        const quantidadeAtual = pegarQuantidadeInput(inputQuantidade) || 1;
        const novaQuantidade = quantidadeAtual + 1;
        inputQuantidade.value = novaQuantidade;
        await atualizarQuantidade(item, novaQuantidade);
    });

    botaoRemover.addEventListener('click', async () => {
        const quantidadeAtual = pegarQuantidadeInput(inputQuantidade) || 1;
        const novaQuantidade = Math.max(1, quantidadeAtual - 1);
        inputQuantidade.value = novaQuantidade;
        await atualizarQuantidade(item, novaQuantidade);
    });
}

function ativarEventListenerBulk(item) {
    const inputQuantidade = item.querySelector('.input-quantidade');
    const bulkBtns = item.querySelectorAll('.bulk-btn');

    bulkBtns.forEach(btn => {
        btn.addEventListener('click', async () => {
            const amount = btn.getAttribute('data-amount');
            let novaQuantidade = 1;

            if (amount === 'max') {
                novaQuantidade = await calcularQuantidadeMaxima(item);
            } else {
                novaQuantidade = parseInt(amount);
            }

            inputQuantidade.value = novaQuantidade;
            await atualizarQuantidade(item, novaQuantidade);
        });
    });
}

async function calcularQuantidadeMaxima(item) {
    const FATOR_CRESCIMENTO = 1.03;
    const PRECO_UNITARIO_INPUT = item.querySelector('.input-preco-unitario');
    let precoBase = parseInt(PRECO_UNITARIO_INPUT.value);
    
    let itemId = parseInt(item.querySelector('.id-item').value);
    let quantidadeAtual = await getUserItemAmount(itemId);
    if (quantidadeAtual == null || quantidadeAtual < 0) {
        quantidadeAtual = 0;
    }

    let userInfo = await getUserInfoToShop();
    if (userInfo == null) return 1;

    let moneyAtual = parseInt(userInfo['money']);

    // M = P * 1.03^Q * ((1.03^N - 1) / 0.03)
    // (0.03 * M) / (P * 1.03^Q) + 1 = 1.03^N
    // N = Math.floor( Math.log10(...) / Math.log10(1.03) )

    let denominador = precoBase * (FATOR_CRESCIMENTO ** quantidadeAtual);
    if (denominador === 0) return 1;

    let interiorLog = ((0.03 * moneyAtual) / denominador) + 1;
    let maxN = Math.floor(Math.log10(interiorLog) / Math.log10(FATOR_CRESCIMENTO));

    if (maxN < 1) maxN = 1;
    if (maxN > 1000) maxN = 1000;

    return maxN;
}

function pegarQuantidadeInput(input) {
    return parseInt(input.value);
}

async function getUserInfoToShop() {
    const CONFIG_GET_USER_INFO = { method: 'GET' };
    return await fetch('/get/user_info', CONFIG_GET_USER_INFO)
        .then((response) => {
            if (!response.ok) {
                throw new Error('Erro ao buscar dados do usuario!');
            }
            return response.json();
        })
        .then((data) => (data['resposta'] === 200 ? data : null))
        .catch((error) => {
            console.error('Erro:', error);
            return null;
        });
}

async function getUserItemAmount(itemId) {
    const CONFIG_FETCH_REQUEST = {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' },
    };

    return await fetch(`/get/item_quant_by_id?item_id=${itemId}`, CONFIG_FETCH_REQUEST)
        .then((response) => {
            if (!response.ok) {
                throw new Error('Erro ao resgatar quantidade de itens do usuario!');
            }
            return response.json();
        })
        .then((data) => {
            if (data['resposta'] !== 200) {
                mini.criarNotificacao(data['resposta'], true);
                return null;
            }
            return data['quantidade'];
        })
        .catch((error) => {
            console.error('Erro:', error);
            return null;
        });
}

async function salvarItem(itemId, quantidade) {
    const COMPRA_REALIZADA = 100;
    const dados = {
        'id-item': itemId,
        'input-quantidade': quantidade,
    };

    const CONFIG_FETCH_REQUEST = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(dados),
    };

    return await fetch('/shop/purchase', CONFIG_FETCH_REQUEST)
        .then((response) => response.ok ? response.json() : null)
        .then((data) => {
            if (data == null) {
                return false;
            }
            if (data['resposta'] !== COMPRA_REALIZADA) {
                mini.criarNotificacao(data['resposta'], true);
                return false;
            }

            mini.criarNotificacao(data['resposta'], false);
            return true;
        })
        .catch((error) => {
            console.error('Erro:', error);
            return false;
        });
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
        if (pItemPrice != null) pItemPrice.innerText = precoFormatado;

        return true;
    }

    let preco = await calcularPreco(item, 1);
    let precoFormatado = formatador(preco, 1);

    inputQuantidade.value = 1;
    if (pItemPrice != null) pItemPrice.innerText = precoFormatado;
    inputPrecoTotal.value = preco;
    
    mini.criarNotificacao(3, true);

    return false;
}

async function calcularPreco(item, novaQuantidade) {
    const FATOR_CRESCIMENTO = 1.03;
    const PRECO_UNITARIO_INPUT = item.querySelector('.input-preco-unitario');

    let precoUnitarioDoInput = parseInt(PRECO_UNITARIO_INPUT.value);
    let itemId = parseInt(item.querySelector('.id-item').value);
    let quantidadeAtual = await getUserItemAmount(itemId);

    if (quantidadeAtual == null || quantidadeAtual < 0) {
        quantidadeAtual = 0;
    }

    const primeiroTermo = precoUnitarioDoInput * (FATOR_CRESCIMENTO ** quantidadeAtual);
    const somaProgressao = (FATOR_CRESCIMENTO ** novaQuantidade - 1) / (FATOR_CRESCIMENTO - 1);
    const precoTotal = primeiroTermo * somaProgressao;

    if (!Number.isFinite(precoTotal)) {
        return Number.MAX_SAFE_INTEGER;
    }

    return Math.ceil(precoTotal);
}

async function comprar(item) {
    const DINHEIRO_INSUFICIENTE = 0;

    let precoTotal = parseInt(item.querySelector('.input-preco-total').value);
    let quantidade = parseInt(item.querySelector('.input-quantidade').value);
    let itemId = parseInt(item.querySelector('.id-item').value);
    let userInfo = await getUserInfoToShop();
    
    if (userInfo == null) {
        mini.criarNotificacao(201, true);
        return;
    }

    let dinheiroAtual = parseInt(userInfo['money']);
    let dinheiroInsuficiente = dinheiroAtual < precoTotal;

    if (dinheiroInsuficiente) {
        mini.criarNotificacao(DINHEIRO_INSUFICIENTE, true);
        return;
    }

    let compraRealizada = await salvarItem(itemId, quantidade);
    if (!compraRealizada) {
        return;
    }

    item.querySelector('.input-quantidade').value = 1;
    await atualizarQuantidade(item, 1);
}

const erros = {
    0: 'Dinheiro insuficiente!',
    1: 'Sem itens disponíveis!',
    2: 'Erro ao atualizar preco!',
    3: 'Apenas quantidade entre: 1, 1000!',
    4: 'Erro ao salvar compra!',
    100: 'Compra realizada com sucesso!',
    200: "Sessão inválida!",
    201: "Erro ao iniciar sessão!",
    4005: "Usuário não encontrado!",
    4004: "Item não encontrado!",
};

var mini = new miniNotificacao(erros);
let itensArray = montarArrayItens();
adicionarEventListeners(itensArray);
