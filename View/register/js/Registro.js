class Registro {
    constructor() {
        this.form         = new Formulario();
        this.notification = new Notificacao();

        this.loginHereBtn = document.getElementById("login-here-button");
        this.submitBtn    = document.getElementById("submit-button");

        this.preventDefaultEvent();
        this.initEventListenerLoginButtons();
    }

    

    
    preventDefaultEvent(){
        this.submitBtn.addEventListener('click', (event) => {
            event.preventDefault();
            this.notification.iniciarNotificacao(this.form.validateInputs());
        });
    }
    
    initEventListenerLoginButtons(){
        this.loginHereBtn.addEventListener('click', (event) => {
            window.location.href = "/login";
        });
    }
}