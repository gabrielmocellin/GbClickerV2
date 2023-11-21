class Item{
    constructor(id, preco, minimum_level, quantidade, nome){
        this.id            = id;
        this.preco         = preco;
        this.minimum_level = minimum_level;
        this.quantidade    = quantidade;
        this.nome          = nome;
    }

    /* 
        Cada item resgatado do banco deve ter um objeto criado no javascript.
        Quando um usuário quiser comprar um item, uma função deve ser chamada com a finalidade de
        incrementar a quantidade do aprimoramento e o dinheiro deve ser descontado, 
        essas mudanças devem ser salvas no banco.
    */

    comprar(){
        if(jogo.money < this.preco){
            alert(`Dinheiro insuficiente para ${this.nome}!`);
            return;
        }

        this.add();
        this.cashOut();

        jogo.UpdateInfo("user_money_p", jogo.money, "R$ "); // Atualizando o dinheiro atual do usuário;
        jogo.UpdateFormPurchase();

        xhrShop.savePurchase();
    }

    cashOut(){
        jogo.money = parseInt(jogo.money) - parseInt(this.preco);
    }

}