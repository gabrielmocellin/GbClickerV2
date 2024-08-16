class Registro
{
    constructor()
    {
        this.form         = new Formulario();
        this.notification = new Notificacao();

        this.loginHereBtn = document.getElementById("login-here-button");
        this.submitBtn    = document.getElementById("submit-button");

        this.preventDefaultEvent();
        this.initEventListenerLoginButtons();
    }

    preventDefaultEvent()
    {
        this.submitBtn.addEventListener('click', (event) => {
            event.preventDefault();
            let notificationMessages = this.form.validateInputs();
            let isNotificationMessagesEmpty = (notificationMessages.length == 0)
            
            if (isNotificationMessagesEmpty) {
                this.form.form.submit();
            } else {
                this.notification.iniciarNotificacao(notificationMessages);
            }
        });
    }
    
    initEventListenerLoginButtons()
    {
        this.loginHereBtn.addEventListener('click', (event) => {
            window.location.href = "/login";
        });
    }

    verificarAvisos(codigoDoAviso)
    {
        let avisos = {
            "0":"Um dos inputs está inválido!",
            "1":"Email inválido!",
            "2":"Senha inválida!",
            "3":"Apelido inválido!",
            "4":"Nenhuma imagem foi enviada!",
            "5":"Tamanho de imagem excedido!",
            "6":"Tamanho de imagem excedido!",
            "7":"Não foi possível mover a imagem!",
            "8":"Email já cadastrado!",
            "9":"Apelido já cadastrado!"
        }
        
        if (avisos.hasOwnProperty(codigoDoAviso)) {
            this.notification.iniciarNotificacao(avisos[codigoDoAviso]);
        }
    }
}
