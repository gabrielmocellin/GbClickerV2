class Item{
    constructor(id, preco, minimum_level, quantidade){
        this.id            = id;
        this.preco         = preco;
        this.minimum_level = minimum_level;
        this.quantidade    = quantidade;
        this.name = "";
    }

    /* 
        Cada item resgatado do banco deve ter um objeto criado no javascript.
        Quando um usuário quiser comprar um item, uma função deve ser chamada com a finalidade de
        incrementar a quantidade do aprimoramento e o dinheiro deve ser descontado, 
        essas mudanças devem ser salvas no banco.
    */

    add(){
        console.log("add Ativado!");
    }

    comprar(){
        if(jogo.usermoney < this.preco){
            alert(`Dinheiro insuficiente para ${this.name}!`);
            return;
        }

        this.add();
        this.cashOut();

        jogo.UpdateUserMoney();
        jogo.UpdateFormPurchase();

        xhrShop.savePurchase();
    }

    cashOut(){
        jogo.usermoney = parseInt(jogo.usermoney) - parseInt(this.preco);
    }

}