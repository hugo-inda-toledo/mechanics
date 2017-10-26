import { Component, ViewEncapsulation , OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import {Observable} from 'rxjs/Rx';
import { MyToastService } from '../../services/toast.service';

import { CitiesService } from '../../modelCtlr/cities.service';
import { CommunesService } from '../../modelCtlr/communes.service';
import { UsersCommunesService } from '../../modelCtlr/users_communes.service';

import { UsersCommune } from '../../models/users_commune.model';
import { Commune } from '../../models/commune.model';
import { City } from '../../models/city.model';
import { User } from '../../models/user.model';


@Component({
  selector: 'datos-area-trabajo',
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'datos-area-trabajo.html'
})

export class DatosAreaTrabajoComponent implements OnInit{
  @Input() user: User;
  @Input() cities: Array<City>;
  @Output() userUpdated = new EventEmitter();

  public communes: Array<Commune>;
  public usersCommunes: Array<UsersCommune>;
  public selectedUsersCommunes: Array<number>;

  public form:FormGroup;
  public city_id:AbstractControl;
  public commune_id:AbstractControl;
  public nameInputs= ['city_id','commune_id'];
  public canEdit: boolean= true;

    constructor(
      fb:FormBuilder,
      private citiesService: CitiesService,
      private communesService: CommunesService,
      private usersCommunesService: UsersCommunesService,
      private myToastService: MyToastService
    ){
      //Formulario
      this.form = fb.group({
          city_id:['', Validators.required],
          commune_id:['', Validators.required],
      });

      this.city_id = this.form.controls['city_id'];
      this.commune_id = this.form.controls['commune_id'];

    }

    ngOnInit(){
      this.city_id.setValue(1);
      Observable.forkJoin([ this.communesService.getByCity(String(1)), this.usersCommunesService.get() ])
       .subscribe((response) => {
         //Respuesta 1
         this.communes = response[0].data;

         //Respuesta 2
         let usersCommuneId= [];
         for(let userCommune of response[1].data){
           usersCommuneId.push(userCommune.commune_id);
         }
         this.selectedUsersCommunes= (<any>Object).assign(usersCommuneId);
         this.commune_id.setValue(usersCommuneId);
         for(let input of this.nameInputs){
           this[input].disable();
         }
       });


    }

    fillDetails(){
      this.city_id.setValue(1);
      console.log(this.selectedUsersCommunes);
      this.commune_id.setValue( this.selectedUsersCommunes );
    }

    getCommunes(cityChoosed: string){
      let self = this;
      this.communesService.getByCity(cityChoosed)
          .subscribe(response => {
              this.communes = response.data;
          });
    }


    onChangeCity(cityChoosed: string){
      this.getCommunes(cityChoosed.split(':')[1].replace(/ /g,''));
    }

    onSubmit(value){
      let communes=[];
      for(let c of value.commune_id){
        communes.push({'commune_id' : c});
      }

      this.usersCommunesService.post(communes)
      .subscribe(response=>{
        if(response.success){
          this.myToastService.addToast('success', { title:'Area de Trabajo', msg:'Se ha modificado con exito el área de trabajo.'});
          this.selectedUsersCommunes= (<any>Object).assign(value.commune_id);
          this.disableInputs();
        }
      });
    }


    disableInputs(){
      this.canEdit = !this.canEdit;

      if(this.canEdit){
        this.form.reset();
        this.fillDetails();
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



}
