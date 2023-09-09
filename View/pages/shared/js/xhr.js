var form_dataUser    = document.getElementById("form-user-save-data");

function saveUserData(){ /* Função criada para salvar o dinheiro valor do clique atual do usuário */

    let xml_request      = new XMLHttpRequest();

    xml_request.onreadystatechange = function (){
        if(xml_request.readyState == 4 && xml_request.status == 200){
            jogo.UpdateFormUserData();
        }
    }

    xml_request.open('POST', 'View/pages/home/exe/saveUserData.php', true);
    xml_request.send(new FormData(form_dataUser));
}

setInterval(saveUserData, 1000);