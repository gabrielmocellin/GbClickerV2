class Minions extends Item
{
    add()
    {
        gioco.usuario.setMinions( gioco.usuario.getMinions() + this.quantidade );
    }
}
