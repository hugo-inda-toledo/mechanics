import { Component, ViewEncapsulation , OnInit, Input, Output, EventEmitter } from '@angular/core';
import { Router } from '@angular/router';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';

import { UsersService } from '../../modelCtlr/users.service';
import { User } from '../../models/user.model';


@Component({
  selector: 'datos-herramientas',
  styleUrls: ['./mi-perfil.scss'],
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'datos-herramientas.html'
})

export class DatosHerramientasComponent implements OnInit {

  @Input() user: User;
  @Output() userUpdated = new EventEmitter();

  public router: Router;

  //input de formulario
  public canEdit:boolean = false;
  public nameInputs= [];
  public inputs:any ={};
  public form:FormGroup;

  //output
  public error: string ='';
  public loading: boolean = false;
    constructor(
      router:Router,
      fb:FormBuilder,
      private usersService: UsersService
    ){
      this.router = router;

      //Formulario
      let inputsObj:any={};
      for(let i = 0 ; i<5 ; i++){
        this.nameInputs.push({ name:'Herramienta '+i, label: 'herramienta-f'+i  ,inputName: 'herramienta'+i ,id: i });
      }

      //Se carga los elementos dinamicamente al form
      for(let input of this.nameInputs){
        inputsObj[input.inputName] = [''];
      }
      this.form = fb.group(inputsObj);

      //Creo una referencia al input en scope del componente
      for(let input of this.nameInputs){
        this.inputs[input.inputName] = this.form.controls[input.inputName];
      }
    }

    ngOnInit() {
      this.disableInputs();
    }

    disableInputs(){
      this.canEdit = !this.canEdit;

      if(this.canEdit){
        this.form.reset();
        for(let input of this.nameInputs){
          this.inputs[input.inputName].disable();
        }
      }
      else{
        for(let input of this.nameInputs){
          this.inputs[input.inputName].enable();
        }
      }
    }

    onSubmit(values){
      console.log(values);
    }


}
