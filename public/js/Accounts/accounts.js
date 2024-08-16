let erros = {
    0:   'Conta editada!',
    100: 'Erro ao salvar no banco!',
    101: 'Apelido inválido!',
    102: 'Valor p/clique inválido!',
    103: 'Dinheiro inválido!',
    104: 'Multiplicador inválido!',
    105: 'Minions inválidos!',
    106: 'Apelido duplicado!'
}

let mini = new miniNotificacao(erros);
window.onload = function() { formatarNumerosNasDivs('.linha p', 1); };

/* Funções utilizadas! */

function alternarVisualizacaoElemento(elemento)
{
    if (elemento.style.display === 'none') {
        elemento.style.display = 'block';
    } else {
        elemento.style.display = 'none';
    }
}

function alternarVisualizacaoListaElementos(arrayElementos)
{
    arrayElementos.forEach((elemento) => {
        alternarVisualizacaoElemento(elemento);
    })
}

function alternarEntreRemoverESalvar(linha)
{
    let botao_salvar = linha.querySelector('#botao-salvar');
    let botao_remover = linha.querySelector('#botao-remover');

    alternarVisualizacaoElemento(botao_salvar);
    alternarVisualizacaoElemento(botao_remover);
}

function edicao(id_linha)
{
    let linha      = document.querySelector(`#id_${id_linha}`);
    let paragrafos = linha.querySelectorAll(`#id_${id_linha} p.info_editaveis`);
    let inputs     = linha.querySelectorAll(`#id_${id_linha} input`);

    alternarVisualizacaoListaElementos(paragrafos);
    alternarVisualizacaoListaElementos(inputs);
    alternarEntreRemoverESalvar(linha);
}

function salvarEdicao(id_linha)
{
    let linha = document.querySelector(`#id_${id_linha}`);

    let nicknameInput   = linha.querySelector(`input[name="nickname_input_${id_linha}"]`);
    let clickValueInput = linha.querySelector(`input[name="clickValue_input_${id_linha}"]`);
    let moneyInput      = linha.querySelector(`input[name="money_input_${id_linha}"]`);
    let multiplierInput = linha.querySelector(`input[name="multiplier_input_${id_linha}"]`);
    let minionsInput    = linha.querySelector(`input[name="minions_input_${id_linha}"]`);

    let dadosEditados = {
        "id":         id_linha,
        "nickname":   nicknameInput.value,
        "clickValue": clickValueInput.value,
        "money":      moneyInput.value,
        "multiplier": multiplierInput.value,
        "minions":    minionsInput.value,
    };

    const CONFIG_FETCH_REQUEST = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(dadosEditados)
    }

    fetch('./accounts/save', CONFIG_FETCH_REQUEST)
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao realizar edição!');
        }
        return response.json();
    })
    .then(data => {
        if (data['resposta'] === 0) {
            mini.criarNotificacao(data['resposta']);
        } else {
            mini.criarNotificacao(data['resposta'], true);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
}