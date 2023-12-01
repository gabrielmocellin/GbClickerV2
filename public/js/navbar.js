class gerenciadorHeader
{
    constructor()
    {
        this.navbarAberto = false;
        this.dropdownPerfilAberto = false;

        this.botaoNavbar = document.getElementById("hamburguer-navbar-button");
        this.divNavbar = document.getElementById("div-menu-navbar");
        this.botaoDropdownPerfil = document.getElementById("imagem_perfil");
        this.divDropdownPerfil = document.getElementById("navbar-conta-dropdown");

        this.iniciarEventListeners();
    }

    iniciarEventListeners()
    {
        if (
            this.botaoNavbar != null &&
            this.botaoDropdownPerfil != null &&
            this.divNavbar != null &&
            this.divDropdownPerfil != null
            ) {
            this.botaoNavbar.addEventListener("click", () => {
                this.closeOpenManager(this.divNavbar, this.navbarAberto);
            });
            this.botaoDropdownPerfil.addEventListener("click", () => {
                this.closeOpenManager(this.divDropdownPerfil, this.dropdownPerfilAberto);
            });
        } else {
            console.log("Erro ao encontrar algum dos menus!");
        }
        
    }

    closeOpenManager(elemento, estadoAtual)
    {
        if (!this[estadoAtual]) {
            elemento.classList.remove("menuClosed");
            this[estadoAtual] = true;
        } else {
            elemento.classList.add("menuClosed");
            this[estadoAtual] = false;
        }
    }

    RedirectPage(op)
    {
        let path = "";
        switch (op) {
            case 1:
                path = "/home";
                break;
            case 2:
                path = "/items";
                break;
            case 3:
                path = "/shop";
                break;
            case 4:
                path = "/logout";
                break;
            default:
                path = "/home";
                break;
        }
        window.location.href = path;
    }
}