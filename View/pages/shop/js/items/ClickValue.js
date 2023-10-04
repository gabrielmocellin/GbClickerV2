class ClickValue extends Item{
    constructor(id, preco, minimum_level, quantidade){
        super(id, preco, minimum_level, quantidade);
        this.name = "ClickValue";
    }

    add(){
        jogo.clickValue = parseInt(jogo.clickValue) + parseInt(this.quantidade);
        console.log("Novo ClickValue : " + jogo.clickValue); // TEMPORÁRIO
    }
}