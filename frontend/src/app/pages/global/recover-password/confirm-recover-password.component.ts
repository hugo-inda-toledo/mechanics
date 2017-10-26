import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';

import { matchingPasswords } from '../../../services/validators.service';

import { UsersService } from '../../../modelCtlr/users.service';

@Component({
    selector: 'confirm-recover-password',
    encapsulation: ViewEncapsulation.None,
    styleUrls: ['./recover-password.scss'],
    templateUrl: './confirm-recover-password.html'
})

export class ConfirmRecoverPasswordComponent implements OnInit {
    hashId: string;
    token:string;
    private sub: any;


    public loading:boolean = false;
    public hashIsCorrect: boolean = false;
    public changePasswordSuccess: boolean = false;
    public messageError:string = '';
    public messageSuccess: string= '';

    //Form
    public form:FormGroup;
    public password:AbstractControl;
    public confirmPassword:AbstractControl;


    constructor(fb:FormBuilder, private activatedRoute :ActivatedRoute, private router: Router , private usersService: UsersService) {
      this.activatedRoute= activatedRoute;
      this.router = router;
      this.usersService= usersService;

      //Formulario
      this.form = fb.group({
          password: ['', Validators.required],
          confirmPassword: ['', Validators.required]
      },{validator: matchingPasswords('password', 'confirmPassword')});

      this.password = this.form.controls['password'];
      this.confirmPassword = this.form.controls['confirmPassword'];
    }

    ngOnInit(){
      this.messageError= '';
      this.messageSuccess='';
      this.loading= true;

      this.sub = this.activatedRoute.params.subscribe(params => {
        this.hashId = ''+params['hashId'];
        this.usersService.confirmRecoverPassword(this.hashId)
        .subscribe(result => {

            this.loading=false;
            if(result.success){
              this.token = result.data.token;
              this.hashIsCorrect= true;
            }
            else{
              this.messageError= 'Ha habido algún error.';
            }
        }, error=>{
            this.loading=false;
            this.messageError= (error._body && JSON.parse(error._body).message) ? JSON.parse(error._body).message : 'Ha habido algún error.';
        });
     });
    }


    onSubmit(values: any){
      if (this.form.valid) {
          this.loading=true;
          this.messageError='';
          this.messageSuccess='';

          this.usersService.changePasswordInRecover( this.token , this.hashId,  values.password ).subscribe(
            result => {
                this.loading = false;
                if (result.success === true) {
                    this.changePasswordSuccess= true;
                    this.messageSuccess= result.data.msg;
                } else {
                    this.messageError = 'Ha habido algún error';
                }
            },
            err => {
              console.log(err);
              this.messageError= (err._body && JSON.parse(err._body).message) ? JSON.parse(err._body).message : 'Ha habido algún error.';
              this.loading = false;
            });
      }
    }

    goLogin(){
      this.router.navigate(['/login']);
    }

    ngOnDestroy() {
      this.sub.unsubscribe();
    }


}
