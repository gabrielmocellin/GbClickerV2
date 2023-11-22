class ClickValue extends Item{
    add(){
        jogo.usuario.setValorDoClique( jogo.usuario.getValorDoClique() + this.quantidade );
    }
}