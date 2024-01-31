let mini = new miniNotificacao();
mini.criarNotificacao(150, true); /* USADO PARA TESTES */

function edicao(id_linha)
{
    let linha      = document.querySelector(`#id_${id_linha}`);
    let paragrafos = linha.querySelectorAll(`#id_${id_linha} p.info_editaveis`);
    let inputs     = linha.querySelectorAll(`#id_${id_linha} input`);

    alternarVisualizacaoDeElementos(paragrafos);
    alternarVisualizacaoDeElementos(inputs);

    alternarBotoesRemoverESalvar(linha);
}

function alternarVisualizacaoDeElementos(arrayElementos)
{
    arrayElementos.forEach((elemento) => {
        alterarVisualizacaoDeElemento(elemento);
    })
}

function alternarBotoesRemoverESalvar(linha)
{
    let botao_salvar = linha.querySelector('#botao-salvar');
    let botao_remover = linha.querySelector('#botao-remover');

    alterarVisualizacaoDeElemento(botao_salvar);
    alterarVisualizacaoDeElemento(botao_remover);
}

function alterarVisualizacaoDeElemento(elemento)
{
    if (elemento.style.display === 'none') {
        elemento.style.display = 'block';
    } else {
        elemento.style.display = 'none';
    }
}

function salvarEdicao(id_linha)
{
    let linha = document.querySelector(`#id_${id_linha}`);

    let dadosEditados = {
        "id":         id_linha,
        "nickname":   linha.querySelector(`input[name="nickname_input_${id_linha}"]`).value,
        "clickValue": linha.querySelector(`input[name="clickValue_input_${id_linha}"]`).value,
        "money":      linha.querySelector(`input[name="money_input_${id_linha}"]`).value,
        "multiplier": linha.querySelector(`input[name="multiplier_input_${id_linha}"]`).value,
        "minions":    linha.querySelector(`input[name="minions_input_${id_linha}"]`).value,
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
            mini.criarNotificacao(data['resposta'], false);
        } else {
            mini.criarNotificacao(data['resposta'], true);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
}