class Login
{
    constructor()
    {
        this.form = new Formulario();
        this.notification = new Notificacao();
        this.loginBtn = document.getElementById("login-button");

        this.preventDefaultEvent();
    }

    preventDefaultEvent()
    {
        this.loginBtn.addEventListener('click', (event) => {
            event.preventDefault();
            this.notification.iniciarNotificacao(this.form.validateInputs());
        });
    }

    verificarAvisos(codigoDoAviso)
    {
        let avisos = {
            "0":"Conta criada com sucesso!",
            "1":"Conta não encontrada!",
            "2":"Logout realizado com sucesso!",
            "3":"Erro ao criar a sessão no PHP!",
            "4":"Acesso apenas para ADMIN's!"
        }
        
        if (avisos.hasOwnProperty(codigoDoAviso)) {
            this.notification.iniciarNotificacao(avisos[codigoDoAviso]);
        }
    }
}
