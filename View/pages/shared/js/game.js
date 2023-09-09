class game{
    constructor(clickValue, usermoney, multiplier){
        this.clickValue = clickValue;
        this.usermoney = usermoney;
        this.multiplier = multiplier;
        this.clicksPerSec = 0;
        
        this.UpdateUserMoney();
        this.UpdateUserMultiplier();
        this.UpdateUserMoneyPerSec();
        
        setInterval(()=>{this.UpdateUserMoneyPerSec();}, 200);
    }
    
    ClickOnClicker(event){
        this.CreateNewCounterElement(event);
        this.AddClickMoneyUser();
        this.UpdateUserMoney();
        
        this.clicksPerSec += 1;
        
        setTimeout(()=>{if(this.clicksPerSec >= 1){this.clicksPerSec -= 1;}}, 1000); /* Depois de 1 segundo o click não será mais contado */
    }
    
    AddClickMoneyUser(){
        this.usermoney += this.clickValue * this.multiplier;
    }

    UpdateUserMoney(){ // Atualiza com o valor salvo nesse objeto a navbar
        let pUserMoney = document.getElementById("user_money_p");
        pUserMoney.textContent = "R$ " + this.usermoney;
    }
    UpdateUserMultiplier(){ // Atualiza com o valor salvo nesse objeto a navbar
        let liUserMultiplier = document.getElementById("user_mult_li");
        liUserMultiplier.textContent = `Mult: ${this.multiplier}x`;
    }
    
    UpdateUserMoneyPerSec(){
        let moneyPerSec = parseFloat(this.clickValue * this.multiplier * this.clicksPerSec);
        let liMoneySec = document.getElementById("money_sec_li");
        
        liMoneySec.textContent = `${moneyPerSec} R$/sec`;
    }
    
    UpdateFormUserData(){
        let input_clickValue = document.getElementById("clickValue-input");
        let input_money      = document.getElementById("money-input");
        let input_multiplier = document.getElementById("multiplier-input");
        
        input_clickValue.value = jogo.clickValue;
        input_money.value      = jogo.usermoney;
        input_multiplier.value = jogo.multiplier;
    }
    
    /* Verificando a posição que o jogador clicou na foto do clicker */
    GetClickPosition(event){
        let cordX = event.clientX;
        let cordY = event.clientY;
        return [cordX, cordY];
    }
    
    /* Com as informações recebidas da função GetClickPosition(), será criado uma div onde será mostrado ao usuário quanto ele ganhou em 1 click */
    CreateNewCounterElement(event){
        let xytuple = this.GetClickPosition(event);
        
        let newCounterElement = document.createElement("div");
        let clickerDiv = document.getElementById("clicker-img-div");
        
        newCounterElement.classList.add("counter-number");
        newCounterElement.textContent = "+" + (this.clickValue * this.multiplier);
        
        clickerDiv.appendChild(newCounterElement);
        
        newCounterElement.style.left = xytuple[0] + "px";
        newCounterElement.style.top  = xytuple[1]-55 + "px";
        
        setTimeout(()=>{newCounterElement.remove();}, 1500);
    }
}