class Minions extends Item{
    add(){
        jogo.minions = parseInt(jogo.minions) + parseInt(this.quantidade);
        console.log("Novo minion : " + jogo.minions); // TEMPORÁRIO
    }
}