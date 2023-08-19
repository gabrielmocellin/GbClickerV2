var aberto = false;
let menuButton = document.getElementById("hamburguer-navbar-button");
let menu = document.getElementById("div-menu-navbar");

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

function RedirectPage(op){
    let path = "";
    switch (op){
        case "1":
            path = "../home/home.php"; break;
        case "2":
            path = "../admin/createTickets.php"; break;
        default:
            path = "../home/home.php"; break;
    }
    if(path != ""){
        window.location.href = path;
    }
}