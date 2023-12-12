class Multiplier extends Item
{
    add()
    {
        gioco.usuario.setMultiplicador( gioco.usuario.getMultiplicador() + this.quantidade );
    }
}
