class Formulario {

    constructor(){ // Construtor
        this.form = document.getElementById("login-form");

        this.emailInput = document.getElementById("email");
        this.passwordInput = document.getElementById("password");

        this.emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        this.passwordRegex = /^(?=.*[A-Z]+)(?=.*\d)[a-zA-Z0-9_-]{4,16}$/;

    }

    validateInputs(){ // Validar todos os inputs
        let notificationMsg = Array(2);
        
        if(!this.validateEmail()){notificationMsg.push("Email inválido!")}
        if(!this.validatePassword()){notificationMsg.push("Senha inválida!")}

        return notificationMsg;
    }

//Validações de inputs presentes no formulário.
    validateEmail(){
        let email = this.emailInput.value;
        if(this.emailRegex.test(email)){
            return true;
        }
        return false;
    }
    validatePassword(){
        let password = this.passwordInput.value;
        if(this.passwordRegex.test(password)){
            return true;
        }
        return false;
    }
}