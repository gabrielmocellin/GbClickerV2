class UserInfoManager
{
    constructor()
    {
        const updateElementInfo = (idDoElemento, valor, prefixo = "", sufixo = "") => {
            const QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA = 1;
            let elementoHtml = document.getElementById(idDoElemento);
            let contidoNaPagina = elementoHtml != null;
            let numeroFormatado = formatador(valor, QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA);
        
            if (contidoNaPagina) {
                elementoHtml.textContent = prefixo + numeroFormatado + sufixo;
            }
        }

        const updateXpBar = (xp, maxToUp) => {
            let xpBar = document.getElementById('level-progress-bar');
            let foundOnPage = xpBar != null;
            if (foundOnPage) {
                let barPercentage = (xp / maxToUp) * 100;
                xpBar.style.setProperty('--progress-width', barPercentage + '%');
            }
        }

        this.updateMoney = (newValue) => {
            updateElementInfo("user_money_p", newValue, "R$ ");
        }

        this.updateClickValue = (newValue) => {
            updateElementInfo("clickValue", newValue, "R$ ", "");
        }

        this.updateMultiplier = (newValue) => {
            updateElementInfo("multiplier", newValue, "Mult: ", " x");
        }
        
        this.updateMinions = (newValue) => {
            updateElementInfo("minions", newValue, "Minions: ");
        }
        
        this.updateMoneyPSec = (newValue) => {
            updateElementInfo("moneypsec", newValue, "", " R$/sec");
        }
        
        this.updateLevel = (newValue) => {
            updateElementInfo("level-info-p", newValue, "LEVEL: ");
        }
        
        this.updateXpBar = (newXpPoints, newMaxToUp) => {
            updateXpBar(newXpPoints, newMaxToUp);
        }
    }

    getUserInfo = async () => {
        const CONFIG_GET_USER_INFO = {
            method: 'GET'
        }
        
        return await fetch('/get/user_info', CONFIG_GET_USER_INFO)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar!');
            }
            return response.json();
        })
        .then(data => {
            if (data['resposta'] == 200) {
                return data;
            }
            mini.criarNotificacao(data['resposta'], true);
            return null;
        })
        .catch(error => {
            console.error('Erro:', error);
            return null;
        });
    }
}
