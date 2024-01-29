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