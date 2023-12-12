class Notificacao
{
    constructor()
    {
        this.divExternaParaCentralizar = document.getElementById("div-notificacao-div");
        this.divInterna = document.getElementById("notificacao-div");
        this.divTextosInterna = document.getElementById("notificacao-textos-div");
        this.ativa = false;
    }

    iniciarNotificacao(avisos)
    {
        if (!this.ativa) {
            this.mostrarNotificacao();
            if (typeof avisos != 'string') {
                avisos.forEach(element => {
                    this.divTextosInterna.innerHTML += element + "</br>";
                } );
            } else {
                this.divTextosInterna.innerHTML += avisos + "</br>";
            }
            
            this.setTempoParaEsconderNotificacao();
        }
    }
    
    mostrarNotificacao()
    {
        this.divExternaParaCentralizar.style.display = "flex";
        this.divInterna.style.display = "flex";
        this.ativa = true;
    }

    setTempoParaEsconderNotificacao()
    {
        setTimeout(()=>{
            this.divInterna.style.display = "none";
            this.divExternaParaCentralizar.style.display = "none";
            this.divTextosInterna.innerHTML = "";
            this.ativa = false;
        }, 8000);
    }
}
