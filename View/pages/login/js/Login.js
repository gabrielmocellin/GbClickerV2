class Login {
    constructor() {
        this.form = new Formulario();
        this.notification = new Notificacao();

        this.registerBtn = document.getElementById("register-button");
        this.loginBtn = document.getElementById("login-button");

        this.preventDefaultEvent();
        this.initEventListenerRegisterButtons();
    }

    

    
    preventDefaultEvent(){
        this.loginBtn.addEventListener('click', (event) => {
            event.preventDefault();
            this.notification.initNotification(this.form.validateInputs());
        });
    }
    
    initEventListenerRegisterButtons(){
        this.registerBtn.addEventListener('click', (event) => {
            window.location.href = "/register";
        });
    }
}