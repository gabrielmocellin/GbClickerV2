class game{
    constructor(valorDoClique, dinheiro, multiplicador, minions, nivel, pontosAtuaisDeNivel, pontosNecessariosParaSubirDeNivel){

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
        
        this.AtualizarValorNoElemento("user_money_p",   this.usuario.getDinheiro(), " R$ ");               // Atualizando Dinheiro atual
        this.AtualizarValorNoElemento("user_mult_li",   this.usuario.getMultiplicador(), "Mult: ", " x"); // Atualizando Multiplicador atual
        this.AtualizarValorNoElemento("minions_sec_li", this.usuario.getMinions(), "Minions: ");          // Atualizando Minions atual
        this.AtualizarValorNoElemento("money_sec_li",   this.CalcularDinheiroPorSegundo(), "", " R$/sec"); // Atualizando R$/sec atual
        this.AtualizarValorNoElemento("level-info-p",   this.usuario.getNivel(), "LEVEL: ");              // Atualizando Level atual
        this.AtualizarBarraDeProgressoDeNivel();
        
        setInterval(()=>{ this.AtualizarValorNoElemento("money_sec_li", this.CalcularDinheiroPorSegundo(), "", " R$/sec"); }, 250);
        setInterval(()=>{
            this.usuario.AddDinheiroPorMinion();
            this.AtualizarValorNoElemento("user_money_p", this.usuario.getDinheiro(), " R$ ");
        }, 1000);

        this.salvarDadosDoUsuarioNoBancoPeriodicamente();
    }

    FormatadorParaDinheiro(num, digits) { // Formatador de números!
        var si = [
          { value: 1,    symbol: ""  },
          { value: 1E3,  symbol: "K" },
          { value: 1E6,  symbol: "M" },
          { value: 1E9,  symbol: "B" },
          { value: 1E12, symbol: "T" },
          { value: 1E15, symbol: "q" },
          { value: 1E18, symbol: "Q" }
        ];
        var rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
        var i;
        for (i = si.length - 1; i > 0; i--) {
          if (Math.abs(num) >= si[i].value) break;
        }
        return (num / si[i].value).toFixed(digits).replace(rx, "$1") + si[i].symbol;
    }

    CalcularDinheiroPorSegundo(){
        return parseFloat( (this.usuario.getValorDoClique() * this.usuario.getMultiplicador() * this.cliquesPorSegundo) + (this.usuario.getMinions() * this.usuario.getValorDoClique() * this.usuario.getMultiplicador()) );
    }
    
    ClickOnClicker(event){
        this.CreateNewCounterElement(event);

        this.usuario.AddDinheiroPorClique();
        this.AtualizarValorNoElemento("user_money_p", this.usuario.getDinheiro(), " R$ "); // Atualizando o dinheiro atual do usuário

        this.usuario.AddPontosAtuaisDeNivel();
        this.AtualizarValorNoElemento("level-info-p", this.usuario.getNivel(), "LEVEL: ");
        this.AtualizarBarraDeProgressoDeNivel();
        
        this.cliquesPorSegundo += 1;

        setTimeout(()=>{if(this.cliquesPorSegundo > 0){this.cliquesPorSegundo -= 1;}}, 1000); /* Depois de 1 segundo o click não será mais contado */
    }

    AtualizarValorNoElemento(idDoElemento, valor, prefixo = "", sufixo = ""){
        const QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA = 1;
        let elementoHtml        = document.getElementById(idDoElemento);
        let contidoNaPagina     = elementoHtml != null;
        let numeroFormatado     = this.FormatadorParaDinheiro(valor, QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA);

        if(contidoNaPagina) elementoHtml.textContent = prefixo + numeroFormatado + sufixo;
    }

    AtualizarBarraDeProgressoDeNivel(){
        let barraDeProgressoDeNivel = document.getElementById('level-progress-bar');
        let contidoNaPagina = barraDeProgressoDeNivel != null;

        if(contidoNaPagina){
            let novoPercentual = (this.usuario.getPontosAtuaisDeNivel() / this.usuario.getPontosNecessariosParaSubirDeNivel()) * 100;
            barraDeProgressoDeNivel.style.setProperty('--progress-width', novoPercentual + '%');
        }
    }

    criarFormulario() {
        let formularioParaSalvarDados = document.createElement('form');

        let valoresParaColocarNosInputs = [
            this.usuario.getValorDoClique(),
            this.usuario.getDinheiro(),
            this.usuario.getMultiplicador(),
            this.usuario.getMinions(),
            this.usuario.getNivel(),
            this.usuario.getPontosAtuaisDeNivel(),
            this.usuario.getPontosNecessariosParaSubirDeNivel()
        ];
        let inputs = [
            'clickValue',
            'money',
            'multiplier',
            'minions',
            'level',
            'xp-points',
            'max-to-up'
        ];

        formularioParaSalvarDados.id = 'form-user-save-data';
        formularioParaSalvarDados.action = '';
        formularioParaSalvarDados.style.display = 'none';
    
        inputs.forEach(function (inputName, indiceRespectivo) {
            let input   = document.createElement('input');
            input.id    = inputName + '-input';
            input.name  = inputName + '-input';
            input.type  = 'text';
            input.value = valoresParaColocarNosInputs[indiceRespectivo]; 
            formularioParaSalvarDados.appendChild(input);
        });

        document.body.appendChild(formularioParaSalvarDados);

        return formularioParaSalvarDados;
    }

    UpdateFormPurchase(){
        let input_clickValue   = document.getElementById("clickValue-input");
        let input_money        = document.getElementById("money-input");
        let input_multiplier   = document.getElementById("multiplier-input");
        let input_minions      = document.getElementById("minions-input");
        
        input_clickValue.value = this.usuario.getValorDoClique();
        input_money.value      = this.usuario.getDinheiro();
        input_multiplier.value = this.usuario.getMultiplicador();
        input_minions.value    = this.usuario.getMinions();
    }
    

    /* Verificando a posição que o jogador clicou na foto do clicker */
    GetClickPosition(event){
        let cordX = event.clientX;
        let cordY = event.clientY;
        return [cordX, cordY];
    }
    

    /* Com as informações recebidas da função GetClickPosition(), será criado uma div onde será mostrado ao usuário quanto ele ganhou em 1 click */
    CreateNewCounterElement(event){
        const QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA = 1;
        let xytuple           = this.GetClickPosition(event);
        
        let newCounterElement = document.createElement("div");
        let clickerDiv        = document.getElementById("clicker-img-div");
        let numeroFormatado    = this.FormatadorParaDinheiro( (this.usuario.getValorDoClique() * this.usuario.getMultiplicador()), QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA);
        
        newCounterElement.classList.add("counter-number");
        newCounterElement.textContent = "+" + numeroFormatado;
        
        clickerDiv.appendChild(newCounterElement);
        
        newCounterElement.style.left  = xytuple[0]    + "px";
        newCounterElement.style.top   = xytuple[1]-55 + "px";
        
        setTimeout(()=>{newCounterElement.remove();}, 1500);
    }

    salvarDadosDoUsuarioNoBancoPeriodicamente(){
        setInterval(()=>{
            let formularioParaSalvarDados = this.criarFormulario();

            let xml_request = new XMLHttpRequest();

            xml_request.onreadystatechange = function (){ if(xml_request.readyState == 4 && xml_request.status == 200) console.log("Salvando no banco...") }
            xml_request.open('POST', 'View/home/exe/saveUserData.php', true);
            xml_request.send(new FormData(formularioParaSalvarDados));

            document.body.removeChild(formularioParaSalvarDados);
        }, 1000);

        
    }
}