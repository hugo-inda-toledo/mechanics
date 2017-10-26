import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';

import { UsersService } from '../../../modelCtlr/users.service';

import { emailValidator } from '../../../services/validators.service';

@Component({
    selector: 'recover-password',
    encapsulation: ViewEncapsulation.None,
    styleUrls: ['./recover-password.scss'],
    templateUrl: './recover-password.html'
})

export class RecoverPasswordComponent implements OnInit {
    public loading:boolean = false;
    public error:string = '';

    public router: Router;
    public form:FormGroup;
    public email:AbstractControl;

    constructor(router:Router, fb:FormBuilder , private usersService: UsersService) {
        this.router = router;
        this.form = fb.group({
            'email': ['', Validators.compose([Validators.required, emailValidator])]
        });

        this.email = this.form.controls['email'];
    }

    public onSubmit(values:any):void {
        if (this.form.valid) {
            this.error= '';
            this.loading= true;

            this.usersService.recoverPassword(values.email)
              .subscribe(response => {
                this.loading= false
                if(response.success === true){
                  document.getElementById("openModalButton").click();
                }
                else{
                  this.error= 'Ha habido algún error';
                }
              },error=>{
                this.loading= false
                this.error= 'Ha habido algún error';
              });
        }
    }

    ngOnInit() {

    }

    redirectLogin(){
      this.router.navigate(['/login']);
    }


}
