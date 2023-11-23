class Notificacao{
    constructor(){
        this.divExternaParaCentralizar = document.getElementById("div-notificacao-div");
        this.divInterna = document.getElementById("notificacao-div");
        this.ativa = false;
    }

    iniciarNotificacao(arrayDeAvisos){
        if(!this.ativa){
            this.mostrarNotificacao();
            arrayDeAvisos.forEach(element => {
                this.divInterna.innerHTML += "<p>" + element + "</p>";
            } );
            this.setTempoParaEsconderNotificacao();
        }
    }
    
    mostrarNotificacao(){
        this.divExternaParaCentralizar.style.display = "flex";
        this.divInterna.style.display = "flex";
        this.ativa = true;
    }

    setTempoParaEsconderNotificacao(){
        setTimeout(()=>{
            this.divInterna.style.display = "none";
            this.divExternaParaCentralizar.style.display = "none";
            this.ativa = false;
        }, 8000);
    }
}