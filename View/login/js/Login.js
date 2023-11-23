class Login {
    constructor() {
        this.form = new Formulario();
        this.notification = new Notificacao();
        this.loginBtn = document.getElementById("login-button");

        this.preventDefaultEvent();
        this.initEventListenerRegisterButtons();
    }

    preventDefaultEvent(){
        this.loginBtn.addEventListener('click', (event) => {
            event.preventDefault();
            this.notification.iniciarNotificacao(this.form.validateInputs());
        });
    }
}