class ClickValue extends Item
{
    add()
    {
        gioco.usuario.setValorDoClique( gioco.usuario.getValorDoClique() + this.quantidade );
    }
}
