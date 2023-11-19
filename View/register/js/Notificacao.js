class Notificacao{
    constructor(){
        this.centerNotificationDiv = document.getElementById("div-notificacao-div");
        this.notificationDiv = document.getElementById("notificacao-div");
        this.active = false;
    }

    initNotification(arrayMsgs){

        if(!this.active){

            this.centerNotificationDiv.style.display = "flex";

            this.active = true;
            arrayMsgs.forEach(element => {this.notificationDiv.innerHTML += "<p>" + element + "</p>";});

            this.notificationDiv.style.display = "flex";

            setTimeout(()=>{
                this.notificationDiv.style.display = "none";
                this.centerNotificationDiv.style.display = "none";
                this.notificationDiv.innerHTML = "";
                this.active = false;
            }, 8000);
        }

    }

}