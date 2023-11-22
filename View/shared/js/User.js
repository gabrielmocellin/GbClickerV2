class User{
    constructor(valorDoClique, dinheiro, multiplicador, minions, nivel, pontosAtuaisDeNivel, pontosNecessariosParaSubirDeNivel){
        this.valorDoClique = valorDoClique;
        this.dinheiro      = dinheiro;
        this.multiplicador = multiplicador;
        this.minions       = minions;

        this.nivel                              = nivel;
        this.pontosAtuaisDeNivel                = pontosAtuaisDeNivel;
        this.pontosNecessariosParaSubirDeNivel  = pontosNecessariosParaSubirDeNivel;        
    }

    AddDinheiroPorClique(){ this.setDinheiro( this.getDinheiro() + this.getValorDoClique() * this.getMultiplicador() ); }

    AddDinheiroPorMinion(){ this.setDinheiro( this.getDinheiro() + this.getValorDoClique() * this.getMinions() * this.getMultiplicador() ); }

    AddPontosAtuaisDeNivel(){
        const PONTO_POR_CLIQUE = 1;
        this.setPontosAtuaisDeNivel(this.getPontosAtuaisDeNivel + PONTO_POR_CLIQUE);
        this.VerificarProgressoNivel();
    }

    VerificarProgressoNivel(){
        const PORCENTAGEM_INCREMENTADA_PONTOS_PARA_UPAR = 10/100;
        const QUANTIDADE_NIVEIS_AVANCADOS = 1;

        if(this.pontosAtuaisDeNivel  >= this.pontosNecessariosParaSubirDeNivel){
            this.setNivel(this.getNivel() + QUANTIDADE_NIVEIS_AVANCADOS);
            this.setPontosAtuaisDeNivel(this.getPontosAtuaisDeNivel - this.getPontosNecessariosParaSubirDeNivel());
            this.setPontosNecessariosParaSubirDeNivel(this.getPontosNecessariosParaSubirDeNivel() + this.getPontosNecessariosParaSubirDeNivel() * PORCENTAGEM_INCREMENTADA_PONTOS_PARA_UPAR);
        }
    }

    // =-=-=-=-=-= Getters =-=-=-=-=-=
    getValorDoClique()                     { return this.valorDoClique; }
    getDinheiro()                          { return this.dinheiro; }
    getMultiplicador()                     { return this.multiplicador; }
    getMinions()                           { return this.minions; }
    getNivel()                             { return this.nivel; }
    getPontosAtuaisDeNivel()               { return this.pontosAtuaisDeNivel; }
    getPontosNecessariosParaSubirDeNivel() { return this.pontosNecessariosParaSubirDeNivel; }

    // =-=-=-=-=-= Setters =-=-=-=-=-=
    setValorDoClique(valor)                     { this.valorDoClique = valor; }
    setDinheiro(valor)                          { this.dinheiro = valor; }
    setMultiplicador(valor)                     { this.multiplicador = valor; }
    setMinions(valor)                           { this.minions = valor; }
    setNivel(valor)                             { this.nivel = valor; }
    setPontosAtuaisDeNivel(valor)               { this.pontosAtuaisDeNivel = valor; }
    setPontosNecessariosParaSubirDeNivel(valor) { this.pontosNecessariosParaSubirDeNivel = valor; }
}