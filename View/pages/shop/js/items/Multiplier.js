class Multiplier extends Item{
    constructor(id, preco, minimum_level, quantidade){
        super(id, preco, minimum_level, quantidade);
        this.name = "Multiplier";
    }

    add(){
        jogo.multiplier = parseInt(jogo.multiplier) + parseInt(this.quantidade);
        console.log("Novo multiplier : " + jogo.multiplier); // TEMPORÁRIO
    }
}