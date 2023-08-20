let closeButton = document.getElementById('closeShop');
let openButton  = document.getElementById('openShop');

let shopDiv = document.getElementById('shop-div')

closeButton.addEventListener('click', () => {
    if(shopDiv.classList.contains('openedShop')){closeShop();}
});

openButton.addEventListener('click', () => {
    if(shopDiv.classList.contains('closedShop')){openShop();}
});

function openShop(){
    shopDiv.classList.remove('closedShop');
    shopDiv.classList.add('openedShop');
}

function closeShop(){
    shopDiv.classList.remove('openedShop');
    shopDiv.classList.add('closedShop');
}