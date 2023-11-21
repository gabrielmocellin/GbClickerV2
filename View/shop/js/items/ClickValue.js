class ClickValue extends Item{
    add(){
        jogo.clickValue = parseInt(jogo.clickValue) + parseInt(this.quantidade);
        console.log("Novo ClickValue : " + jogo.clickValue); // TEMPORÁRIO
    }
}