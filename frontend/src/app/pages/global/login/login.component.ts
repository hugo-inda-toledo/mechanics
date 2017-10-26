import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { Router, ActivatedRoute} from '@angular/router';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';

import { emailValidator } from '../../../services/validators.service';
import { AuthenticationService } from '../../../auth/authentication.service';

@Component({
    selector: 'login',
    encapsulation: ViewEncapsulation.None,
    styleUrls: ['./login.scss'],
    templateUrl: './login.html'
})

export class LoginComponent implements OnInit {
    loading = false;
    error = '';
    returnUrl: string;

    public user: any;
    public form:FormGroup;
    public email:AbstractControl;
    public password:AbstractControl;

    constructor(
      private route: ActivatedRoute,
      private router: Router,
      fb:FormBuilder ,
      private authenticationService: AuthenticationService
    ) {
        this.form = fb.group({
            'email': ['', Validators.compose([Validators.required, emailValidator])],
            'password': ['', Validators.compose([Validators.required, Validators.minLength(6)])]
        });

        this.email = this.form.controls['email'];
        this.password = this.form.controls['password'];
    }

    public onSubmit(values:any):void {
        if (this.form.valid) {
            console.log(values);
            this.login(values.email, values.password);
        }
    }

    ngOnInit() {
        // reset login status
        this.authenticationService.logout();

        // get return url from route parameters or default to '/'
        this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/';
    }

    login(username: string, password: string) {
        this.loading = true;
        this.authenticationService.login(username, password)
            .subscribe(result => {

                // login successful
                if (result === true) {
                    this.user= this.authenticationService.getUser();

                    //Redirect by last url visited
                    if(this.returnUrl !== '/'){
                      this.router.navigate([this.returnUrl]);
                    }
                    //Redirect default by role
                    else{
                      if(this.user.role===5){
                        this.router.navigate(['/pages/solicitar-servicios']);
                      }
                      else{
                        this.router.navigate(['/pages/trabajo']);
                      }
                    }


                } else {
                    // login failed
                    this.error = 'Usuario o contraseña incorrecta';
                    this.loading = false;
                }
            }, error=>{
              this.error = 'Usuario o contraseña incorrecta';
              this.loading = false;
            });
    }
}
