class Multiplier extends Item{
    add(){
        jogo.usuario.setMultiplicador( jogo.usuario.getMultiplicador() + this.quantidade );
    }
}