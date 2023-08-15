var aberto = false;
let menuButton = document.getElementById("hamburguer-navbar-button");
let menu = document.getElementById("div-menu-navbar");

console.log(menuButton);
console.log(menu);

menuButton.addEventListener("click", CloseOpenMenu);

function CloseOpenMenu(){
    if(aberto == false){
        menu.classList.remove("menuClosed");
        aberto = true;
    } else{
        menu.classList.add("menuClosed");
        aberto = false;
    }
}