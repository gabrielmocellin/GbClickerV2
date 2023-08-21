var form_dataUser    = document.getElementById("form-user-save-data");

var input_clickValue = document.getElementById("clickValue-input");
var input_money      = document.getElementById("money-input");
var input_multiplier = document.getElementById("multiplier-input");

function saveUserData(){ /* Função criada para salvar o dinheiro valor do clique atual do usuário */

    let xml_request      = new XMLHttpRequest();

    xml_request.onreadystatechange = function (){
        if(xml_request.readyState == 4 && xml_request.status == 200){
            input_clickValue.value = jogo.clickValue;
            input_money.value      = jogo.usermoney;
            input_multiplier.value = jogo.multiplier;
        }
    }

    xml_request.open('POST', 'View/pages/home/exe/saveUserData.php', true);
    xml_request.send(new FormData(form_dataUser));

}

setInterval(saveUserData, 1000);