import { Injectable } from '@angular/core';
import { ToastyService, ToastyConfig, ToastOptions, ToastData } from 'ng2-toasty';

export class MessageToastOptions{
    public title: string;
    public msg: string;
    public timeout: number;
    public theme: string;
    public showClose: boolean;
    constructor(options: Object){
        this.title = options['title'];
        this.msg = options['msg'];
        this.theme = options['theme'];
        this.showClose = options['showClose'];
    }
}

export class MessageToast{
    public type: string;
    public options: MessageToastOptions;
    constructor(type: string, options){
        this.type = type;
        this.options = new MessageToastOptions(options);
    }
}

@Injectable()
export class MyToastService {

    private messageList: Array<MessageToast> = [];
    private theme: string = 'bootstrap';

    constructor(
      private toastyService:ToastyService,
      private toastyConfig: ToastyConfig,
    ) {
        this.toastyConfig.theme = 'bootstrap';
    }

    public addToast(type : string, { title , msg, timeout = 4000, later = false }) {
        // Almacenar mensajes para después.
        if(later){
            let message = new MessageToast(type, {title: title, msg: msg, timeout: timeout, showClose: true, theme: this.theme});
            this.messageList.push(message);
        }
        // Lanzar mensaje Toast.
        else{
            var toastOptions:ToastOptions = {
                title: title,
                msg: msg,
                showClose: true,
                timeout: timeout,
                theme: this.theme

            };
            this.toastyService[type](toastOptions);
        }
    }


    public hasMessages(){
        if(this.messageList.length > 0){
            this.showMessages();
        }
    }

    private showMessages(){
        for(let msg of this.messageList){
            this.toastyService[msg.type](msg.options);
        }
        this.messageList = [];
    }

}
