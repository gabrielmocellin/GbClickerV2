class game{
    constructor(clickValue){
        this.clickValue = clickValue;
    }

    GetPosition(event){
        let cordX = event.clientX;
        let cordY = event.clientY;
        console.log("Cordenada x: " + cordX);
        console.log("Cordenada y: " + cordY);
        return [cordX, cordY];
    }

    CreateNewCounterElement(event){
        let xytuple = this.GetPosition(event);

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

    newClickValue(newValue){
        this.clickValue = newValue;
    }
}