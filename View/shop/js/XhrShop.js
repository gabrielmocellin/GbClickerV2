class XhrShop{
    constructor(){
        this.formPurchase = document.getElementById("form-purchase");
    }

    savePurchase(){ /* Função criada para salvar as informações atuais do usuário */

        let request = new XMLHttpRequest();

        request.onreadystatechange = function (){
            if(request.readyState == 4 && request.status == 200){
                console.log("State == 4 && requestStatus == 200");
            }
        }

        request.open('POST', 'View/shop/exe/savePurchase.php', true);
        request.send(new FormData(this.formPurchase));
    }
}