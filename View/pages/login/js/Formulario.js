class Formulario {

    constructor(){ // Construtor
        this.form = document.getElementById("login-form");

        this.emailInput = document.getElementById("email");
        this.passwordInput = document.getElementById("password");

        this.emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    }

    validateInputs(){ // Validar todos os inputs
        let notificationMsg = Array(1);
        
        if(!this.validateEmail()){
            notificationMsg.push("Email inválido!")
            return notificationMsg;
        }

        if(this.validatePassword()){
            return this.form.submit();
        }

        alert("Preencha os campos!");
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
        if(password.length > 0){return true;}
        return false;        
    }
}