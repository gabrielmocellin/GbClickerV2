window.onload = function() {
    formatarNumerosNasDivs('p.item-price', 1);
};

const erros = {
    0: 'Dinheiro insuficiente!<br>Atual: ' + formatador(gioco.usuario.dinheiro, 1)
};

var mini = new miniNotificacao(erros);

mini.criarNotificacao(0, true);