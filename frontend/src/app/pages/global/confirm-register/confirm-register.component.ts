import { Component, ViewEncapsulation, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { UsersService } from '../../../modelCtlr/users.service';

@Component({
    selector: 'confirm-register',
    encapsulation: ViewEncapsulation.None,
    styleUrls: ['./confirm-register.scss'],
    templateUrl: './confirm-register.html'
})

export class ConfirmRegisterComponent implements OnInit, OnDestroy{
    hashId: string;
    private sub: any;
    loading: boolean;
    messageError: string;
    messageSuccess:string;

    constructor(private activatedRoute :ActivatedRoute, private route: Router , private usersService: UsersService) {
      this.activatedRoute= activatedRoute;
      this.route = route;
      this.usersService= usersService;
    }

    ngOnInit(){
      this.messageError= '';
      this.messageSuccess='';
      this.loading= true;

      this.sub = this.activatedRoute.params.subscribe(params => {
        this.hashId = ''+params['hashId'];
        this.usersService.activateAccount(this.hashId)
        .subscribe(result => {
            this.loading=false;
            if(result.success){
              this.messageSuccess= '¡Felicidades!. Su registro se ha completado con éxito';
            }
            else{
              this.messageError= 'Ha habido algún error, es posible que tu cuenta ya halla sido activada.';
            }
        }, error=>{
            this.loading=false;
            this.messageError= 'Ha habido algún error, es posible que tu cuenta ya halla sido activada.';
        });
     });
    }

    goLogin(){
      this.route.navigate(['/login']);
    }

    ngOnDestroy() {
      this.sub.unsubscribe();
    }
}
