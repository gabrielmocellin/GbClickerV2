class Minion extends Item{
    constructor(id, preco, minimum_level, quantidade){
        super(id, preco, minimum_level, quantidade);
        this.name = "Minion";
    }

    add(){
        jogo.minion = parseInt(jogo.minion) + parseInt(this.quantidade);
        console.log("Novo minion : " + jogo.minion); // TEMPORÁRIO
    }
}