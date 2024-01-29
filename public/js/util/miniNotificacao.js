class miniNotificacao
{
    criarNotificacao(texto, isErro) {
        var container = document.getElementById('container_mini_notificacoes');

        var notificacaoDivExterior = this.criarDivExterior(isErro);
    
        var notificacaoDiv = document.createElement('div');
        notificacaoDiv.id = 'mini_notificacao_div';
    
        var imagemDiv = this.criarImagemAPartirDoTipoDeNotificacao(isErro);
        var textoH3 = this.criarTexto(texto);
        
        notificacaoDiv.appendChild(imagemDiv);
        notificacaoDiv.appendChild(textoH3);
        notificacaoDivExterior.appendChild(notificacaoDiv);
    
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

    criarTexto(texto) {
        var textoH3 = document.createElement('h3');

        textoH3.id = 'mini_notificacao_texto';
        textoH3.innerHTML = texto;

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

    timerRemocaoNotificacao(elementoContainer, elemento) {
        const TEMPO_PARA_REMOCAO = 4000;

        setTimeout(() => {
            elemento.classList.add('remover-notificacao')
        }, TEMPO_PARA_REMOCAO-1000)

        setTimeout(() => {
            elementoContainer.removeChild(elemento)
        }, TEMPO_PARA_REMOCAO)
    }
}