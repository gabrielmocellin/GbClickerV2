class game{
    constructor(clickValue, money, multiplier, minions, level, xp_points, max_to_up){
        this.clickValue = clickValue;
        this.money      = money;
        this.multiplier = multiplier;
        this.minions    = minions;

        this.level      = level;
        this.xp_points  = xp_points;
        this.max_to_up  = max_to_up;
        
        this.clicksPerSec = 0;
        
        this.UpdateInfo("user_money_p", this.money, "R$ ");               // Atualizando Dinheiro atual
        this.UpdateInfo("user_mult_li", this.multiplier, "Mult: ", " x"); // Atualizando Multiplicador atual
        this.UpdateInfo("minions_sec_li", this.minions, "Minions: ");     // Atualizando Minions atual
        this.UpdateInfo("money_sec_li", parseFloat(this.clickValue*this.multiplier*this.clicksPerSec) + parseFloat(this.minions*this.clickValue*this.multiplier), "", "R$/sec");     // Atualizando R$/sec atual
        this.UpdateInfo("level-info-p", this.level, "LEVEL: ");          // Atualizando Level atual
        this.UpdateLevelBar();
        
        setInterval(()=>{ this.UpdateInfo("money_sec_li", parseFloat(this.clickValue*this.multiplier*this.clicksPerSec) + parseFloat(this.minions*this.clickValue*this.multiplier), "", "R$/sec"); }, 200);
        setInterval(()=>{ this.AddMinionMoney();        }, 1000);
    }

    nFormatter(num, digits) { //formatador de números
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
          if (Math.abs(num) >= si[i].value) {
            break;
          }
        }
        return (num / si[i].value).toFixed(digits).replace(rx, "$1") + si[i].symbol;
    }
    
    ClickOnClicker(event){
        this.CreateNewCounterElement(event);
        this.AddClickMoneyUser();
        this.AddClickXp();
        
        this.clicksPerSec += 1;
        
        setTimeout(()=>{if(this.clicksPerSec >= 1){this.clicksPerSec -= 1;}}, 1000); /* Depois de 1 segundo o click não será mais contado */
    }
    
    AddClickMoneyUser(){
        this.money += this.clickValue * this.multiplier;
        this.UpdateInfo("user_money_p", this.money, "R$ "); // Atualizando o dinheiro atual do usuário
    }
    AddMinionMoney(){
        this.money += this.clickValue * this.minions * this.multiplier;
        this.UpdateInfo("user_money_p", this.money, "R$ "); // Atualizando o dinheiro atual do usuário
    }
    AddClickXp(){
        this.xp_points += 1;
        this.LevelUpVerify();
        this.UpdateLevelBar();
    }

    UpdateInfo(elementId, valor, prefixo = "", sufixo = ""){
        let element        = document.getElementById(elementId);
        let existInPage    = element != null;
        let formatedNumber = this.nFormatter(valor, 1);

        // console.log(`Valor encontrado: ${valor}`);
        if(existInPage) element.textContent = prefixo + formatedNumber + sufixo;
    }


    
    UpdateLevelBar(){
        let levelBar = document.getElementById('level-progress-bar');
        let existInPage = levelBar != null;

        if(existInPage){
            let new_percent = (this.xp_points/this.max_to_up) * 100;
            levelBar.style.setProperty('--progress-width', new_percent + '%');
        }
    }

    LevelUpVerify(){
        if(this.xp_points  >= this.max_to_up){
            this.level     += 1;
            this.xp_points -= this.max_to_up;
            this.max_to_up += this.max_to_up*0.10;
            this.UpdateInfo("level-info-p", this.level, "LEVEL: ");
        }
    }

    UpdateFormUserData(){
        let input_clickValue   = document.getElementById("clickValue-input");
        let input_money        = document.getElementById("money-input");
        let input_multiplier   = document.getElementById("multiplier-input");
        let input_minions      = document.getElementById("minions-input");
        let input_level        = document.getElementById("level-input");
        let input_xp_points    = document.getElementById("xp-points-input");
        let input_max_to_up    = document.getElementById("max-to-up-input");
        
        input_clickValue.value = this.clickValue;
        input_money.value      = this.money;
        input_multiplier.value = this.multiplier;
        input_minions.value    = this.minions;
        input_level.value      = this.level;
        input_xp_points.value  = this.xp_points;
        input_max_to_up.value  = this.max_to_up;
    }

    UpdateFormPurchase(){
        let input_clickValue   = document.getElementById("clickValue-input");
        let input_money        = document.getElementById("money-input");
        let input_multiplier   = document.getElementById("multiplier-input");
        let input_minions      = document.getElementById("minions-input");
        
        input_clickValue.value = this.clickValue;
        input_money.value      = this.money;
        input_multiplier.value = this.multiplier;
        input_minions.value    = this.minions;
    }
    

    /* Verificando a posição que o jogador clicou na foto do clicker */
    GetClickPosition(event){
        let cordX = event.clientX;
        let cordY = event.clientY;
        return [cordX, cordY];
    }
    

    /* Com as informações recebidas da função GetClickPosition(), será criado uma div onde será mostrado ao usuário quanto ele ganhou em 1 click */
    CreateNewCounterElement(event){
        let xytuple           = this.GetClickPosition(event);
        
        let newCounterElement = document.createElement("div");
        let clickerDiv        = document.getElementById("clicker-img-div");
        let formatedNumber    = this.nFormatter((this.clickValue*this.multiplier), 1);
        
        newCounterElement.classList.add("counter-number");
        newCounterElement.textContent = "+" + formatedNumber;
        
        clickerDiv.appendChild(newCounterElement);
        
        newCounterElement.style.left  = xytuple[0]    + "px";
        newCounterElement.style.top   = xytuple[1]-55 + "px";
        
        setTimeout(()=>{newCounterElement.remove();}, 1500);
    }

}