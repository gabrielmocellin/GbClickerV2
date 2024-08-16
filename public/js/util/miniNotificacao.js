class miniNotificacao
{
    erros;

    constructor(erros) {
        this.erros = erros;
    }

    criarNotificacao(codigoErro, isErro=false) {
        var container              = document.getElementById('container_mini_notificacoes');
        var notificacaoDivExterior = this.criarDivExterior(isErro);
        var notificacaoDivInterior = this.criarDivInterior();
        var imagemDiv              = this.criarImagemAPartirDoTipoDeNotificacao(isErro);
        var textoH3                = this.criarTexto(codigoErro);

        notificacaoDivInterior.appendChild(imagemDiv);
        notificacaoDivInterior.appendChild(textoH3);
        notificacaoDivExterior.appendChild(notificacaoDivInterior );
        container.appendChild(notificacaoDivExterior);

        this.timerRemocaoNotificacao(container, notificacaoDivExterior);
    }

    criarDivExterior(isErro) {
        let notificacaoDivExterior = document.createElement('div');

        if (isErro) {
            notificacaoDivExterior.id = 'mini_notificacao_div_exterior_erro';
        } else {
            notificacaoDivExterior.id = 'mini_notificacao_div_exterior';
        }

        return notificacaoDivExterior;
    }

    criarDivInterior() {
        let divInterior = document.createElement('div');
        divInterior.id = 'mini_notificacao_div';
        return divInterior;
    }

    criarTexto(codigoErro) {
        var textoH3 = document.createElement('h3');

        textoH3.id = 'mini_notificacao_texto';

        if (typeof codigoErro == 'string') {
            textoH3.innerHTML = codigoErro;
        } else {
            textoH3.innerHTML = this.identificarErroRetornandoTexto(codigoErro);
        }
        
        return textoH3;
    }

    criarImagemAPartirDoTipoDeNotificacao(isErro) {
        let imagemDiv = document.createElement('div');

        imagemDiv.id = 'imagem';
        imagemDiv.alt = 'imagem_status';

        if (isErro) {
            imagemDiv.style.backgroundImage = "url('../../img/icons/closeIconNotificacao.gif')";
        } else {
            imagemDiv.style.backgroundImage = "url('../../img/icons/checkIconNotificacao.gif')";
        }

        return imagemDiv;
    }

    identificarErroRetornandoTexto(codigoErro) {
        return this.erros[codigoErro];
    }

    timerRemocaoNotificacao(elementoContainer, elemento) {
        const TEMPO_PARA_REMOCAO = 4000;

        setTimeout(() => { elemento.classList.add('remover-notificacao'); }, TEMPO_PARA_REMOCAO - 1000);
        setTimeout(() => { elementoContainer.removeChild(elemento); }, TEMPO_PARA_REMOCAO);
    }
}