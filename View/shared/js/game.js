class game{
    constructor(clickValue, usermoney, multiplier, minions, level, xp_points, max_to_up){
        this.clickValue = clickValue;
        this.usermoney  = usermoney;
        this.multiplier = multiplier;
        this.minions    = minions;

        this.level      = level;
        this.xp_points  = xp_points;
        this.max_to_up  = max_to_up;

        this.clicksPerSec = 0;
        
        this.UpdateUserMoney();
        this.UpdateUserMultiplier();
        this.UpdateUserMinions();
        this.UpdateUserMoneyPerSec();
        this.UpdateLevel();
        this.UpdateLevelBar();
        
        setInterval(()=>{ this.UpdateUserMoneyPerSec(); }, 200);
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
        this.usermoney += this.clickValue * this.multiplier;
        this.UpdateUserMoney();
    }
    AddMinionMoney(){
        this.usermoney += this.clickValue * this.minions * this.multiplier;
        this.UpdateUserMoney();
    }
    AddClickXp(){
        this.xp_points += 1;
        this.LevelUpVerify();
        this.UpdateLevelBar();
    }

    UpdateUserMoney(){ // Atualiza com o valor salvo nesse objeto a navbar
        let pUserMoney     = document.getElementById("user_money_p");
        let existInPage    = pUserMoney != null;
        let formatedNumber = this.nFormatter(this.usermoney, 1);
        if(existInPage){
            pUserMoney.textContent = "R$ " + formatedNumber;
        }
    }
    UpdateUserMultiplier(){ // Atualiza com o valor salvo nesse objeto a navbar
        let liUserMultiplier = document.getElementById("user_mult_li");
        let existInPage      = liUserMultiplier != null;
        let formatedNumber = this.nFormatter(this.multiplier, 1);

        if(existInPage){
            liUserMultiplier.textContent = `Mult: ${formatedNumber} x`;
        }
    }
    UpdateUserMinions(){
        let liUserMinions  = document.getElementById("minions_sec_li");
        let existInPage    = liUserMinions != null;
        let formatedNumber = this.nFormatter(this.minions, 1);

        if(existInPage){
            liUserMinions.textContent = `Minions: ${formatedNumber}`;
        }
    }
    UpdateUserMoneyPerSec(){
        let moneyPerSec    = parseFloat(this.clickValue * this.multiplier * this.clicksPerSec) + parseFloat(this.minions * this.clickValue * this.multiplier);
        let liMoneySec     = document.getElementById("money_sec_li");
        let existInPage    = liMoneySec != null;
        let formatedNumber = this.nFormatter(moneyPerSec, 1);
        
        if(existInPage){
            liMoneySec.textContent = `${formatedNumber} R$/sec`;
        }
    }
    UpdateLevelBar(){
        let levelBar = document.getElementById('level-progress-bar');
        let existInPage = levelBar != null;

        if(existInPage){
            let new_percent = (this.xp_points/this.max_to_up) * 100;
            levelBar.style.setProperty('--progress-width', new_percent + '%');
        }
    }
    UpdateLevel(){
        let level_p = document.getElementById("level-info-p");
        let existInPage = level_p != null;

        if(existInPage){
            level_p.textContent = `LEVEL: ${this.level}`;
        }
    }

    LevelUpVerify(){
        if(this.xp_points  >= this.max_to_up){
            this.level     += 1;
            this.xp_points -= this.max_to_up;
            this.max_to_up += this.max_to_up*0.10;
            this.UpdateLevel();
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
        input_money.value      = this.usermoney;
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
        input_money.value      = this.usermoney;
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