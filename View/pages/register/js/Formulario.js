class Formulario {

    constructor(){ // Construtor
        this.form = document.getElementById("register-form");

        this.emailInput = document.getElementById("email");
        this.userInput = document.getElementById("username");
        this.passwordInput = document.getElementById("password");
        this.confirmInput = document.getElementById("confirm-password");

        this.imgInput = document.getElementById('image-input');
        this.imgPrev = document.getElementById('image-preview');

        this.emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        this.userRegex = /^[a-zA-Z0-9_-]{3,20}$/;
        this.passwordRegex = /^(?=.*[A-Z]+)(?=.*\d)[a-zA-Z0-9_-]{4,16}$/;

        this.imgVerified = false;

        this.initEventListenerImg();
    }

    initEventListenerImg(){ // Validar imagem ao alterar escolha
        this.imgInput.addEventListener("change", () => {
            this.validateImg();
        });
    }

    validateInputs(){ // Validar todos os inputs
        let notificationMsg = Array(5);
        
        if(!this.validateEmail()){notificationMsg.push("Email inválido!")}
        if(!this.validateUser()){notificationMsg.push("Usuário inválido!")}
        if(!this.validatePassword()){notificationMsg.push("Senha inválida!")}
        if(!this.validateConfirm()){notificationMsg.push("Senhas não coincidem!")}

        if(this.imgInput.files.length == 0){
            notificationMsg.push("Imagem não selecionada!");
        } else if(this.imgVerified == false){
            notificationMsg.push("Imagem inválida!");
        }

        return notificationMsg;

    }

//Validações de inputs presentes no formulário.
    validateImg(){
        let fileType = this.imgInput.files[0].type;

        if (fileType === "image/png" || fileType === "image/jpeg" || fileType === "image/jpg") {
            this.imgPrev.src = URL.createObjectURL(this.imgInput.files[0]);
            this.imgVerified = true;
            return;
        }
        alert("Imagem inválida!");
        this.imgPrev.src = "";
        this.imgVerified = false;
        return;
    }
    validateEmail(){
        let email = this.emailInput.value;
        if(this.emailRegex.test(email)){
            return true;
        }
        return false;
    }
    validateUser(){
        let user = this.userInput.value;
        if(this.userRegex.test(user)){
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
    validateConfirm(){
        let confirm = this.confirmInput.value;
        if(confirm == this.passwordInput.value){
            return true;
        }
        return false;
    }
}