class Minions extends Item{
    constructor(id, preco, minimum_level, quantidade){
        super(id, preco, minimum_level, quantidade);
        this.name = "Minions";
    }

    add(){
        jogo.minions = parseInt(jogo.minions) + parseInt(this.quantidade);
        console.log("Novo minion : " + jogo.minions); // TEMPORÁRIO
    }
}