import { Component, ViewEncapsulation , OnInit, Input, Output, EventEmitter } from '@angular/core';
import { Router } from '@angular/router';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import { MyToastService } from '../../services/toast.service';

import { UsersService } from '../../modelCtlr/users.service';
import { User } from '../../models/user.model';

import { matchingPasswords } from '../../services/validators.service';

@Component({
  selector: 'datos-contrasenia',
  styleUrls: ['./mi-perfil.scss'],
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'datos-contrasenia.html'
})

export class DatosContraseniaComponent implements OnInit {

  @Input() user: User;
  @Output() userUpdated = new EventEmitter();

  public router: Router;

  //input de formulario
  public canEdit:boolean = false;
  public nameInputs= ['oldpassword','password', 'confirmPassword'];
  public form:FormGroup;

  public oldpassword: AbstractControl;
  public password:AbstractControl;;
  public confirmPassword:AbstractControl;

  //output
  public error: string ='';
  public loading: boolean = false;
    constructor(
      router:Router,
      fb:FormBuilder,
      public usersService: UsersService,
      private myToastService: MyToastService
    ){
      this.router = router;

      //Formulario
      this.form = fb.group({
        oldpassword: ['', Validators.required],
        password: ['', Validators.required],
        confirmPassword: ['', Validators.required]
      }, {validator: matchingPasswords('password', 'confirmPassword')});

        this.oldpassword = this.form.controls['oldpassword'];
        this.password = this.form.controls['password'];
        this.confirmPassword = this.form.controls['confirmPassword'];

        //Servicios
        this.usersService= usersService;
    }

    ngOnInit() {

    }

    disableInputs(){
      this.canEdit = !this.canEdit;

      if(this.canEdit){
        this.form.reset();
        for(let input of this.nameInputs){
          this[input].disable();
        }
      }
      else{
        for(let input of this.nameInputs){
          this[input].enable();
        }
      }
    }


    onSubmit(values){
      this.loading = true;
      //Si alguno cambio se ejecuta el ws
        this.usersService.changePassword(this.user.id, values.oldpassword, values.password)
            .subscribe(result => {

                if (result.success === true) {
                  this.error ='';
                  this.loading = false;
                  this.form.reset();
                  this.myToastService.addToast('success', { title:'Cambio de contraseña', msg:'Se ha cambiado la contraseña con exito' });
                } else {
                    this.loading = false;
                    this.form.get('oldpassword').setErrors({ notActualPassword: true});
                    this.error = result.data.msg;
                }

            }, error=>{
              this.error = 'Disculpe, no se pudo editar el registro';
              this.loading = false;
            });
    }


    clearActualPasswordError(event){
      this.form.get('oldpassword').setErrors({ notActualPassword: false});
    }


}
