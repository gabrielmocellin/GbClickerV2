let mini = new miniNotificacao();

function edicao(id_linha) {
    let linha = document.querySelector(`#id_${id_linha}`);

    let paragrafos = linha.querySelectorAll(`#id_${id_linha} p.info_editaveis`);
    let inputs = linha.querySelectorAll(`#id_${id_linha} input`);

    alternarVisualizacaoDeElementos(paragrafos);
    alternarVisualizacaoDeElementos(inputs);

    alternarBotoesRemoverESalvar(linha);
}

function alternarVisualizacaoDeElementos(arrayElementos) {
    arrayElementos.forEach((elemento) => {
        alterarVisualizacaoDeElemento(elemento);
    })
}

function alternarBotoesRemoverESalvar(linha) {
    let botao_salvar = linha.querySelector('#botao-salvar');
    let botao_remover = linha.querySelector('#botao-remover');

    alterarVisualizacaoDeElemento(botao_salvar);
    alterarVisualizacaoDeElemento(botao_remover);
}

function alterarVisualizacaoDeElemento(elemento) {
    if (elemento.style.display === 'none') {
        elemento.style.display = 'block';
    } else {
        elemento.style.display = 'none';
    }
}

function salvarEdicao2(id_linha) {

    let linha = document.querySelector(`#id_${id_linha}`);

    let dadosEditados = {
        "id": id_linha,
        "nickname": linha.querySelector(`input[name="nickname_input_${id_linha}"]`),
        "clickValue": linha.querySelector(`input[name="clickValue_input_${id_linha}"]`),
        "money": linha.querySelector(`input[name="money_input_${id_linha}"]`),
        "multiplier": linha.querySelector(`input[name="multiplier_input_${id_linha}"]`),
        "minions": linha.querySelector(`input[name="minions_input_${id_linha}"]`),
    };

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        let statusComuns = xhr.status == 200 || xhr.status == 0;
        if (!statusComuns) {
            xhr.abort();
        }
    }

    xhr.open('POST', './accounts/save', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(dadosEditados));

    console.log("FIM");
}

function salvarEdicao(id_linha) {
    let linha = document.querySelector(`#id_${id_linha}`);

    let dadosEditados = {
        "id": id_linha,
        "nickname": linha.querySelector(`input[name="nickname_input_${id_linha}"]`).value,
        "clickValue": linha.querySelector(`input[name="clickValue_input_${id_linha}"]`).value,
        "money": linha.querySelector(`input[name="money_input_${id_linha}"]`).value,
        "multiplier": linha.querySelector(`input[name="multiplier_input_${id_linha}"]`).value,
        "minions": linha.querySelector(`input[name="minions_input_${id_linha}"]`).value,
    };

    fetch('./accounts/save', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dadosEditados)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao realizar edição!');
        }
        return response.json();
    })
    .then(data => {
        if (data['resposta']) {
            mini.criarNotificacao("Conta editada com sucesso!", false);
        } else {
            mini.criarNotificacao("Erro ao editar conta!", true);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
}