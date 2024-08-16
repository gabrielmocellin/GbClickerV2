const getUserInfo = async () => {
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


/* Verificando a posição que o jogador clicou na foto do clicker */
const getClickPosition = (e) => {
    let cordenadaX = e.clientX;
    let cordenadaY = e.clientY;
    return [cordenadaX, cordenadaY];
}


/* Com as informações recebidas da função GetClickPosition(), será criado uma div onde será mostrado ao usuário quanto ele ganhou em 1 click */
const createNewCounterElement = (e, money) => {
    const QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA = 1;
    let xytuple = getClickPosition(e);
    
    let newCounterElement = document.createElement("div");
    let clickerDiv = document.getElementById("clicker-img-div");
    
    let numeroFormatado = formatador(money, QUANTIDADE_CASAS_DEPOIS_DA_VIRGULA);
    
    newCounterElement.classList.add("counter-number");
    newCounterElement.textContent = "+" + numeroFormatado;
    
    clickerDiv.appendChild(newCounterElement);
    
    newCounterElement.style.left = xytuple[0] + "px";
    newCounterElement.style.top = xytuple[1]-55 + "px";
    
    setTimeout(() => { newCounterElement.remove(); }, 1500);
}


const clickOnClicker = async (e) => {
    if(saveClick()) {
        let data = await getUserInfo();
        createNewCounterElement(e, data['clickValue'] * data['multiplier']);
        updateAllGameInfo();
    }
}


const saveClick = async () => {
    const CONFIG_FETCH_REQUEST = {
        method: 'POST',
    }

    return fetch('/post/click_save', CONFIG_FETCH_REQUEST)
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao salvar!');
            return false;
        }
        return response.json();
    })
    .then(data => {
        if (data['resposta'] != 200) {
            mini.criarNotificacao(data['resposta'], true);
            return false;
        } else {
            return true;
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        return false;
    });
    
}


const updateAllGameInfo = async () => {
    let data = await getUserInfo();

    if (data != null) {
        userInfoManager.updateMoney(data['money']);
        userInfoManager.updateClickValue(data['clickValue']);
        userInfoManager.updateMultiplier(data['multiplier']);
        userInfoManager.updateMinions(data['minions']);
        userInfoManager.updateMoneyPSec(data['minions'] * data['multiplier']);
        userInfoManager.updateLevel(data['level']);
        userInfoManager.updateXpBar(data['xp_points'], data['max_to_up']);

        return true;
    }

    return false;    
}


const removeLoader = () => {
    let loader = document.getElementById("loader-background");
    if (loader != null) {
        loader.style.animation = "disappear 0.2s linear";
        loader.remove();
    }
}


const initializeGame = async () => {
    if (await updateAllGameInfo()) {
        removeLoader();
    }
}

(async () => {

    const collectMinionsMoney = async () => {

        const CONFIG_FETCH_REQUEST = {
            method: 'POST',
        }
    
        return fetch('/post/minions_money', CONFIG_FETCH_REQUEST)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao salvar!');
                return false;
            }
            return response.json();
        })
        .then(data => {
            if (data['resposta'] != 200) {
                mini.criarNotificacao(data['resposta'], true);
                return false;
            } else {
                return true;
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            return false;
        });
        
    }

    if (await updateAllGameInfo()) {
        removeLoader();
        setInterval(()=>{collectMinionsMoney(); updateAllGameInfo()}, 1000);
    }
})();