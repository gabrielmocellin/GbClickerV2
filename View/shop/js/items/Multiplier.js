class Multiplier extends Item{
    add(){
        jogo.multiplier = parseInt(jogo.multiplier) + parseInt(this.quantidade);
        console.log("Novo multiplier : " + jogo.multiplier); // TEMPORÁRIO
    }
}