class Notificacao{
    constructor(){
        this.notificationDiv = document.getElementById("notificacao-div");
        this.active = false;
    }

    initNotification(arrayMsgs){

        if(!this.active){
            this.active = true;
            arrayMsgs.forEach(element => {this.notificationDiv.innerHTML += "<p>" + element + "</p>";});

            this.notificationDiv.style.display = "flex";

            setTimeout(()=>{
                this.notificationDiv.style.display = "none";
                this.notificationDiv.innerHTML = "";
                this.active = false;
            }, 8000);
        }

    }

}