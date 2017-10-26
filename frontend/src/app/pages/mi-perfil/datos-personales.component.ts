import { Component, ViewEncapsulation , OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';

import { AuthenticationService } from '../../auth/authentication.service';
import { UsersService } from '../../modelCtlr/users.service';
import { CitiesService } from '../../modelCtlr/cities.service';
import { CommunesService } from '../../modelCtlr/communes.service';
import { MyToastService } from '../../services/toast.service';

import { Commune } from '../../models/commune.model';
import { City } from '../../models/city.model';
import { User, UserRoles } from '../../models/user.model';

@Component({
  selector: 'datos-personales',
  styleUrls: ['./mi-perfil.scss'],
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'datos-personales.html'
})

export class DatosPersonalesComponent implements OnInit {

  @Input() user: User;
  @Input() cities: Array<City>;
  @Output() userUpdated = new EventEmitter();

  //public cities: Array<City>;
  public communes: Array<Commune>;
  public genders: Array<{id:string , name: string}>= [
     {'id': 'f', 'name': 'Mujer'},
     {'id': 'm', 'name':'Hombre'}
  ];
  public userRoles = UserRoles;

  //input de formulario
  public canEdit:boolean = false;
  public nameInputs= ['firstName', 'last_name', 'sex', 'phone1', 'phone2', 'city_id', 'commune_id', 'address_name', 'address_number', 'address_complement'];
  public form:FormGroup;

  public firstName:AbstractControl;
  public last_name:AbstractControl;
  public sex: AbstractControl;
  public phone1:AbstractControl;
  public phone2:AbstractControl;
  public city_id:AbstractControl;
  public commune_id:AbstractControl;
  public address_name: AbstractControl;
  public address_number: AbstractControl;
  public address_complement: AbstractControl;
  public password:AbstractControl;
  public confirmPassword:AbstractControl;

  //output
  public error: string ='';
  public loading: boolean = false;

  constructor(
      fb:FormBuilder,
      private usersService: UsersService,
      private communesService: CommunesService,
      private citiesService: CitiesService,
      private authService: AuthenticationService,
      private myToastService: MyToastService
  ){

      //Formulario
      this.form = fb.group({
          firstName: ['', Validators.compose([Validators.required, Validators.minLength(3)])],
          last_name: ['', Validators.compose([Validators.required, Validators.minLength(3)]) ],
          sex:[''],
          phone1:['', Validators.required],
          phone2:[''],
          city_id:['', Validators.required],
          commune_id:['', Validators.required],
          address_name: ['', Validators.required],
          address_number: ['', Validators.required],
          address_complement: [''],
      });

        this.firstName = this.form.controls['firstName'];
        this.last_name = this.form.controls['last_name'];
        this.sex = this.form.controls['sex'];
        this.phone1 = this.form.controls['phone1'];
        this.phone2 = this.form.controls['phone2'];
        this.city_id = this.form.controls['city_id'];
        this.commune_id = this.form.controls['commune_id'];
        this.address_name = this.form.controls['address_name'];
        this.address_number = this.form.controls['address_number'];
        this.address_complement = this.form.controls['address_complement'];
    }

    ngOnInit() {
        //Cargo ciudades
        /*this.citiesService.get().subscribe(response => {
          this.cities = response.data;
        });*/

        //Cargo comunas
        this.getCommunes( String(this.user.city_id) );

        //Inicializo inputs con datos de user
        this.disableInputs();
    }

    fillDetails(){
      //Relleno formulario con la info de user
      for(let input of this.nameInputs){
        if(input === 'firstName'){
          this.firstName.setValue(this.user.name);
        }
        else{
          this[input].setValue(this.user[input]);
        }
      }
    }

    getCommunes(cityChoosed: string){
      this.communesService.getByCity(cityChoosed)
          .subscribe(response => {
              this.communes = response.data;
          });
    }

    onChangeCity(cityChoosed: string){
      this.getCommunes(cityChoosed.split(':')[1].replace(/ /g,''));
    }

    disableInputs(){
      this.canEdit = !this.canEdit;

      if(this.canEdit){
        this.form.reset();
        this.fillDetails();
        for(let input of this.nameInputs){
          if(input === 'firstName'){
            this.firstName.disable();
          }
          else{
            this[input].disable();
          }
        }
      }
      else{
        for(let input of this.nameInputs){
          if(input === 'firstName'){
            this.firstName.enable();
          }
          else{
            this[input].enable();
          }
        }
      }

    }

    onSubmit(values){
      this.loading = true;

      //Se revisan los inputs que cambiaron
      let obj2update={}
      for(let input of this.nameInputs){
        if(this[input].touched){
          if(input === 'firstName'){
            obj2update['name'] = values['firstName'];
          }
          else{
            obj2update[input] = values[input];
          }
        }
      }

      //Si alguno cambio se ejecuta el ws
      if(Object.keys(obj2update).length > 0){
        this.usersService.edit(this.user.id, obj2update)
            .subscribe(result => {
                if (result.success === true) {
                  this.user = (<any>Object).assign({}, this.user, obj2update );
                  this.userUpdated.emit(obj2update);
                  this.disableInputs();
                  this.myToastService.addToast('success', { title:'Datos Personales', msg:'Se ha editado con exito' });
                } else {
                    // update failed
                    this.error = 'Disculpe, no se pudo editar el registro';
                    this.loading = false;
                }

            }, error=>{
              this.error = 'Disculpe, no se pudo editar el registro';
              this.loading = false;
            });
      }
      else{
        this.myToastService.addToast('warning', { title:'Datos Personales', msg:'No ha habido cambios que guardar.' });
        this.disableInputs();
      }
    }


}
