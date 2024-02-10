class Gioco
{
    constructor(
        valorDoClique,
        dinheiro,
        multiplicador,
        minions,
        nivel,
        pontosAtuaisDeNivel,
        pontosNecessariosParaSubirDeNivel
    )
    {
        this.usuario = new User(
            valorDoClique,
            dinheiro,
            multiplicador,
            minions,
            nivel,
            pontosAtuaisDeNivel,
            pontosNecessariosParaSubirDeNivel
        );

        this.cliquesPorSegundo = 0;
        this.atualizarValoresAoInicializar();
        this.iniciarIntervalosAoInicializar();
    }

    iniciarIntervalosAoInicializar()
    {
        setInterval(() => {
            this.AtualizarValorNoElemento("moneypsec", this.CalcularDinheiroPorSegundo(), "", " R$/sec");
        }, 250);

        setInterval(() => {
            let possuiMinions = this.usuario.minions > 0;

            if (possuiMinions) {
                this.usuario.AddDinheiroPorMinion();
                this.AtualizarValorNoElemento("user_money_p", this.usuario.getDinheiro(), " R$ ");
                this.salvarDinheiro();
            }

        }, 1000);
    }

    /* Método que ao inicializar a página coloca os dados do usuário nos devidos campos. */
    atualizarValoresAoInicializar()
    {
        let dinheiro = this.usuario.getDinheiro();
        let valorDoClique = this.usuario.getValorDoClique();
        let multiplicador = this.usuario.getMultiplicador();
        let minions = this.usuario.getMinions();
        let dinheiroPorSegundo = this.CalcularDinheiroPorSegundo();
        let nivel = this.usuario.getNivel();

        this.AtualizarValorNoElemento("user_money_p", dinheiro, "R$ ");
        this.AtualizarValorNoElemento("clickValue", valorDoClique, "R$ ", "");
        this.AtualizarValorNoElemento("multiplier", multiplicador, "Mult: ", " x");
        this.AtualizarValorNoElemento("minions", minions, "Minions: ");
        this.AtualizarValorNoElemento("moneypsec", dinheiroPorSegundo, "", " R$/sec");
        this.AtualizarValorNoElemento("level-info-p", nivel, "LEVEL: ");

        this.AtualizarBarraDeProgressoDeNivel();
    }

    /* Método utilizado para formatar números maiores que mil para facilitar leitura. */
    FormatadorParaDinheiro(numero, precisao)
    {
        var valoresSufixosMap = [
          { valor: 1,    sufixo: ""  },
          { valor: 1E3,  sufixo: "K" },
          { valor: 1E6,  sufixo: "M" },
          { valor: 1E9,  sufixo: "B" },
          { valor: 1E12, sufixo: "T" },
          { valor: 1E15, sufixo: "q" },
          { valor: 1E18, sufixo: "Q" },
          { valor: 1E21, sufixo: "s" },
          { valor: 1E24, sufixo: "S" },
          { valor: 1E27, sufixo: "O" },
          { valor: 1E30, sufixo: "N" },
          { valor: 1E33, sufixo: "D" }
        ];
        //var regex = /\.0+$|(\.[0-9]*[1-9])0+$/;
        var chave;
        for (chave = valoresSufixosMap.length - 1; chave > 0; chave--) {
            let sufixoEncontrado = Math.abs(numero) >= valoresSufixosMap[chave].valor;
            if (sufixoEncontrado) {
              break;
            }
        }

        let numeroSimplificado = numero / valoresSufixosMap[chave].valor;
        let numeroFormatado = numeroSimplificado.toFixed(precisao);
        let isCentenaOuMenos = valoresSufixosMap[chave].valor === 1;
        if (isCentenaOuMenos) {
            numeroFormatado = numeroSimplificado;
        }
        let stringFormatada = numeroFormatado + valoresSufixosMap[chave].sufixo;

        return stringFormatada;
    }

    CalcularDinheiroPorSegundo()
    {
        let dinheiroRecebidoPorCliques = this.usuario.getValorDoClique() * this.usuario.getMultiplicador() * this.cliquesPorSegundo;
        let dinheiroRecebidoPorMinions = this.usuario.getMinions() * this.usuario.getMultiplicador();
        let dinheiroPorSegundo = parseFloat(dinheiroRecebidoPorCliques + dinheiroRecebidoPorMinions);

        return dinheiroPorSegundo;
    }
    
    ClickOnClicker(event)
    {
        this.CreateNewCounterElement(event);

        this.usuario.AddDinheiroPorClique();
        this.usuario.AddPontosAtuaisDeNivel();
        this.AtualizarValorNoElemento("user_money_p", this.usuario.getDinheiro(), " R$ "); // Atualizando o dinheiro atual do usuário
        this.AtualizarValorNoElemento("level-info-p", this.usuario.getNivel(), "LEVEL: ");
        this.AtualizarBarraDeProgressoDeNivel();
        
        this.cliquesPorSegundo += 1;

        setTimeout(() => {
            if (this.cliquesPorSegundo > 0) {
                this.cliquesPorSegundo -= 1;
            }
        }, 1000); /* Depois de 1 segundo o click não será mais contado */

        //this.salvarDadosAtuais();
        this.salvarDinheiro();
    }

    AtualizarValorNoElemento(idDoElemento, valor, prefixo = "", sufixo = "")
    {
        const QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA = 1;

        let elementoHtml = document.getElementById(idDoElemento);
        let contidoNaPagina = elementoHtml != null;
        let numeroFormatado = this.FormatadorParaDinheiro(valor, QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA);

        if (contidoNaPagina) {
            elementoHtml.textContent = prefixo + numeroFormatado + sufixo;
        }
    }

    AtualizarBarraDeProgressoDeNivel()
    {
        let barraDeProgressoDeNivel = document.getElementById('level-progress-bar');
        let contidoNaPagina = barraDeProgressoDeNivel != null;

        if (contidoNaPagina) {
            let novoPercentual = (this.usuario.getPontosAtuaisDeNivel() / this.usuario.getPontosNecessariosParaSubirDeNivel()) * 100;
            barraDeProgressoDeNivel.style.setProperty('--progress-width', novoPercentual + '%');
        }
    }

    /* Verificando a posição que o jogador clicou na foto do clicker */
    GetClickPosition(event)
    {
        let cordenadaX = event.clientX;
        let cordenadaY = event.clientY;
        return [cordenadaX, cordenadaY];
    }


    /* Com as informações recebidas da função GetClickPosition(), será criado uma div onde será mostrado ao usuário quanto ele ganhou em 1 click */
    CreateNewCounterElement(event)
    {
        const QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA = 1;
        let xytuple = this.GetClickPosition(event);
        
        let newCounterElement = document.createElement("div");
        let clickerDiv = document.getElementById("clicker-img-div");
        let numeroFormatado = this.FormatadorParaDinheiro( (this.usuario.getValorDoClique() * this.usuario.getMultiplicador()), QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA);
        
        newCounterElement.classList.add("counter-number");
        newCounterElement.textContent = "+" + numeroFormatado;
        
        clickerDiv.appendChild(newCounterElement);
        
        newCounterElement.style.left = xytuple[0] + "px";
        newCounterElement.style.top = xytuple[1]-55 + "px";
        
        setTimeout(() => {
            newCounterElement.remove();
        }, 1500);
    }

    salvarDadosAtuais()
    {

        let dadosUsuarioAtuais = {
            "clickValue":this.usuario.getValorDoClique(),
            "money":this.usuario.getDinheiro(),
            "multiplier":this.usuario.getMultiplicador(),
            "minions":this.usuario.getMinions(),
            "level":this.usuario.getNivel(),
            "xp-points":this.usuario.getPontosAtuaisDeNivel(),
            "max-to-up":this.usuario.getPontosNecessariosParaSubirDeNivel(),
        };

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            let statusComuns = xhr.status == 200 || xhr.status == 0;
            if (!statusComuns) {
                console.log("[ERRO] Erro inesperado: " + xhr.status);
                xhr.abort();
            }
        }

        xhr.open('POST', '/home/save', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify(dadosUsuarioAtuais));
    }

    salvarDinheiro() {
        let dinheiro = this.usuario.getDinheiro();

        let dados = {
            "money": dinheiro
        };

        const CONFIG_FETCH_REQUEST = {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(dados)
        }

        fetch('/save/money', CONFIG_FETCH_REQUEST)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao salvar!');
            }
            return response.json();
        })
        .then(data => {
            if (data['resposta'] != 200) {
                mini.criarNotificacao(data['resposta'], true);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    }
}
