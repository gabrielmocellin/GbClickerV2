class Notificacao
{
    constructor()
    {
        this.divExternaParaCentralizar = document.getElementById("div-notificacao-div");
        this.divInterna = document.getElementById("notificacao-div");
        this.ativa = false;
    }

    iniciarNotificacao(avisos)
    {
        if (!this.ativa) {
            this.mostrarNotificacao();
            if (typeof avisos != 'string') {
                avisos.forEach(element => {
                    this.divInterna.innerHTML += "<p>" + element + "</p>";
                } );
            } else {
                this.divInterna.innerHTML += "<p>" + avisos + "</p>";
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
            this.divInterna.innerHTML = "";
            this.ativa = false;
        }, 8000);
    }
}
