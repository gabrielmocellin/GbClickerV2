class Minions extends Item{
    add(){
        jogo.usuario.setMinions( jogo.usuario.getMinions() + this.quantidade );
    }
}