class game{
    constructor(clickValue, usermoney){
        this.clickValue = clickValue;
        this.usermoney = usermoney;
    }

    setClickValue(newValue){
        this.clickValue = newValue;
    }

    ClickOnClicker(event){
        this.CreateNewCounterElement(event);
        this.usermoney += this.clickValue;
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
        newCounterElement.textContent = "+" + this.clickValue;

        clickerDiv.appendChild(newCounterElement);

        newCounterElement.style.left = xytuple[0] + "px";
        newCounterElement.style.top  = xytuple[1]-55 + "px";

        setTimeout(()=>{
            newCounterElement.remove();
        },1500);
    }

    UpdateUserMoney(){
        let pUsermoney = document.getElementById("user_money_p");
        pUsermoney.textContent = "R$ " + this.usermoney;
    }
}