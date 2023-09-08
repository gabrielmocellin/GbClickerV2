class Registro {
    constructor() {
        this.formulario = document.getElementById("register-form");
        this.imagePreview = document.getElementById('image-preview');
        this.imageInput = document.getElementById('image-input');
        this.botaoRegistrar = document.getElementById("submit-button");

        this.divLoginButton = document.getElementById("login-here-button");
        this.loginButton = document.getElementById("login-button");

        this.emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        this.usernameRegex = /^[a-zA-Z0-9_-]{3,20}$/;
        this.passwordRegex = /^(?=.*[A-Z]+)(?=.*\d)[a-zA-Z0-9_-]{4,16}$/;

        this.iniciarEventListenerImagem();
        this.previnirEventoPadrao();
        this.iniciarEventListenerLoginButton();
    }

    iniciarEventListenerImagem(){
        this.imageInput.addEventListener("change", () => this.imagePreview.src = URL.createObjectURL(this.imageInput.files[0]));
    }

    iniciarEventListenerLoginButton(){
        this.divLoginButton.addEventListener('click', (event) => {
            window.location.href = "/login";
        });

        this.loginButton.addEventListener('click', (event) => {
            window.location.href = "/login";
        });
    }

    previnirEventoPadrao(){
        this.botaoRegistrar.addEventListener('click', (event) => {
            event.preventDefault();
            this.validarInputs();
        });
    }

    validarInputs(){
        let passwordValue = document.getElementById("password").value;
        if(!this.validarEmail()){alert("Email inválido!")}
        if(!this.validarUsuario()){alert("Usuário inválido!")}
        if(!this.validarSenha(passwordValue)){alert("Senha inválida!")}
        if(!this.validarConfirmacao(passwordValue)){alert("Senhas não coincidem!")}
    }

    validarEmail(){
        let emailValue = document.getElementById("email").value;
        if(this.emailRegex.test(emailValue)){
            return true;
        }
        return false;
    }
    validarUsuario(){
        let usernameValue = document.getElementById("username").value;
        if(this.usernameRegex.test(usernameValue)){
            return true;
        }
        return false;
    }
    validarSenha(senha){
        if(this.passwordRegex.test(senha)){
            return true;
        }
        return false;
    }
    validarConfirmacao(senha){
        let confirmValue = document.getElementById("confirm").value;
        if(confirmValue == senha){
            return true;
        }
        return false;
    }
}