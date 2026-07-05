let erros = {
    0:   'Conta editada!',
    100: 'Erro ao salvar no banco!',
    101: 'Apelido inválido!',
    103: 'Dinheiro inválido!',
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

    let nicknameInput = linha.querySelector(`input[name="nickname_input_${id_linha}"]`);
    let moneyInput    = linha.querySelector(`input[name="money_input_${id_linha}"]`);

    let dadosEditados = {
        "id":       id_linha,
        "nickname": nicknameInput.value,
        "money":    moneyInput.value,
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
            
            let paragrafos = linha.querySelectorAll(`p.info_editaveis`);
            if (paragrafos.length >= 2) {
                paragrafos[0].innerText = nicknameInput.value;
                paragrafos[0].title = nicknameInput.value;
                paragrafos[1].innerText = moneyInput.value;
                
                formatarNumerosNasDivs(`#id_${id_linha} p`, 1);
            }
            
            edicao(id_linha);
        } else {
            mini.criarNotificacao(data['resposta'], true);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
}

function removerConta(id_linha)
{
    if (confirm('Tem certeza que deseja remover esta conta? Esta ação não pode ser desfeita.')) {
        const payload = { "id": id_linha };
        const CONFIG_FETCH_REQUEST = {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(payload)
        };

        fetch('./accounts/delete', CONFIG_FETCH_REQUEST)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao deletar conta!');
            }
            return response.json();
        })
        .then(data => {
            if (data['resposta'] === 0) {
                alert('Conta removida com sucesso!');
                let linha = document.querySelector(`#id_${id_linha}`);
                if (linha) {
                    linha.remove();
                }
            } else {
                alert('Erro ao remover conta: ' + (data['message'] || 'Erro desconhecido.'));
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro de comunicação com o servidor.');
        });
    }
}