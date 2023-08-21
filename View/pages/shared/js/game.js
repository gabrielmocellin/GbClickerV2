class game{
    constructor(clickValue, usermoney, multiplier){
        this.clickValue = clickValue;
        this.usermoney = usermoney;
        this.multiplier = multiplier;

        this.UpdateUserMoney();
        this.UpdateUserMultiplier();
    }

    ClickOnClicker(event){
        this.CreateNewCounterElement(event);
        this.AddClickMoneyUser();
        this.UpdateUserMoney();
    }

    GetClickPosition(event){
        let cordX = event.clientX;
        let cordY = event.clientY;
        return [cordX, cordY];
    }

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

    UpdateUserMoney(){
        let pUserMoney = document.getElementById("user_money_p");
        pUserMoney.textContent = "R$ " + this.usermoney;
    }
    UpdateUserMultiplier(){
        let liUserMultiplier = document.getElementById("user_mult_li");
        liUserMultiplier.textContent = `Mult: ${this.multiplier}x`;
    }

    AddClickMoneyUser(){
        this.usermoney += this.clickValue * this.multiplier;
    }
}