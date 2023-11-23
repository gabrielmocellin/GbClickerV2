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
        if(jogo.usuario.getDinheiro() < this.preco){
            alert(`Dinheiro insuficiente para ${this.nome}!`);
            return;
        }

        this.add();
        this.cashOut();

        jogo.AtualizarValorNoElemento("user_money_p", jogo.usuario.getDinheiro(), "R$ "); // Atualizando o dinheiro atual do usuário;
    }

    cashOut(){
        jogo.usuario.setDinheiro(jogo.usuario.getDinheiro() - this.preco);
    }

}