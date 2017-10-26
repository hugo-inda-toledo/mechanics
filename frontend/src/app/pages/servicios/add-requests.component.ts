import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { CarsService } from '../../modelCtlr/cars.service';
import { RequestsService } from '../../modelCtlr/requests.service';
import { Car } from '../../models/car.model';
import { Request } from '../../models/request.model';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import { Router } from '@angular/router';
import { Location } from '@angular/common';
import { ActivatedRoute } from '@angular/router';

import { UsersService } from '../../modelCtlr/users.service';
import { CitiesService } from '../../modelCtlr/cities.service';
import { CommunesService } from '../../modelCtlr/communes.service';

import { CustomComboboxHoras } from '../../services/custom.init.inputs';
import { StatusRequestByNames } from '../../services/status.requests';

import { Commune } from '../../models/commune.model';
import { City } from '../../models/city.model';


@Component({
  selector: 'add-requests',
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'add-requests.html'
})

export class AddRequestsComponent implements OnInit {
    loading = false;
    error = '';
    cars : Array<any>;
    requests : Array<any>;
    usersAddress : any;
    private sub: any;
    public nameInputs= ['address_name', 'address_number', 'address_complement','city_id','commune_id'];
    public requests_types : Array<any>;
    public avaliables_services : Array<any>;
    public avaliables_services_add : Array<any> = [];
    public avaliables_services_add2 : Array<any> = [];
    public router: Router;
    public form:FormGroup;
    public car_id:AbstractControl;
    public address_name:AbstractControl;
    public address_number:AbstractControl;
    public address_complement:AbstractControl;
    public city_id:AbstractControl;
    public commune_id:AbstractControl;
    public total_price:AbstractControl;
    public start_time_schedule_requested:AbstractControl;
    public type_documents_payment:AbstractControl;
    public avaliables_service_id:AbstractControl;
    public hora_id:AbstractControl;
    public diagnostics_id: number = 0;

    public itemsServices:Array<any>;

    public cities: Array<City>;
    public communes: Array<Commune>;
    public horas: Array<any> = CustomComboboxHoras.values;

    public modal_title_success:string;
    public modal_body_success:string;

    constructor(
        private carsService: CarsService,
        private requestsService: RequestsService,
        router:Router,
        fb:FormBuilder,
        private _location: Location,
        private communesService: CommunesService,
        private citiesService: CitiesService,
        private usersService: UsersService,
        private activateRoute: ActivatedRoute
      ) {
        this.router = router;
        this.form = fb.group({
            'car_id':                        ['', Validators.required],
            'address_name':                  ['', Validators.compose([Validators.required, Validators.minLength(2)])],
            'address_number':                ['', Validators.compose([Validators.required, Validators.minLength(1)])],
            'address_complement':            [''],
            'city_id':                       ['', Validators.required],
            'commune_id':                    ['', Validators.required],
            'start_time_schedule_requested': ['', Validators.required],
            'hora_id': ['', Validators.required],
            'avaliables_service_id'        : ['']
        });

        this.car_id                        = this.form.controls['car_id'];
        this.address_name                  = this.form.controls['address_name'];
        this.address_number                = this.form.controls['address_number'];
        this.address_complement            = this.form.controls['address_complement'];
        this.city_id                       = this.form.controls['city_id'];
        this.commune_id                    = this.form.controls['commune_id'];
        this.start_time_schedule_requested = this.form.controls['start_time_schedule_requested'];
        this.avaliables_service_id         = this.form.controls['avaliables_service_id'];
        this.hora_id                       = this.form.controls['hora_id'];

    }

    public onSubmit(values:any):void {
        if (this.form.valid) {
            if(this.avaliables_services_add  && this.avaliables_services_add.length>0){
                this.addRequest(values.car_id, values.city_id, values.commune_id, values.address_name, values.address_number, values.address_complement, values.start_time_schedule_requested, values.hora_id);
            }else{
                console.log('debe seleccionar el servicio');
            }
            console.log(values);
        }
    }

    ngOnInit() {
          this.requestsService.getRequestsTypes()
            .subscribe(response => {
                this.requests_types = response.data;
            });
          this.getCars();
          this.citiesService.get()
            .subscribe(response => {
                this.cities = response.data;
            });
         this.getUser();

         let _self = this;
          this.sub = this.activateRoute.params.subscribe(params => {
           _self.diagnostics_id = +params['id'];
        });
    }

    onChangeCity(cityChoosed: string){
      console.log(cityChoosed);
      // this.communesService.getByCity(cityChoosed.split(':')[1].replace(/ /g,''))
      this.communesService.getByCity(cityChoosed)
          .subscribe(response => {
              this.communes = response.data;
       });
    }

    getCars(){
      // get cars
      this.carsService.getCars()
        .subscribe(response => {
          // this.cars = response.data;
          if(response && response.data){
            this.cars = response.data;
          }
        });
    }
    getUser(){
      // get cars
      this.citiesService.get()
            .subscribe(response => {
                this.cities = response.data;
            });
      this.usersService.get()
        .subscribe(response => {
          // this.cars = response.data;
          if(response && response.data){
            console.log(response.data);
            this.onChangeCity(response.data.city_id);
            this.usersAddress = {
                address_name: response.data.address_name,
                address_number: response.data.address_number,
                address_complement: response.data.address_complement,
                city_id: response.data.city_id,
                commune_id: response.data.commune_id,
            };

          }
        });
    }

    getAddressHome(){
      //console.log('setear mi direccion');
      for(let input of this.nameInputs){
        this[input].setValue(this.usersAddress[input]);
      }
    }

    onChangeRequestsTypes(requestsTypesChoosed: string){
      console.log();
      this.requestsService.getByRequestsTypes(requestsTypesChoosed)
          .subscribe(response => {
              this.avaliables_services = response.data;
              console.log(response.data);
          });
      if(requestsTypesChoosed=='4'){
        this['car_id'].setValue(0);
      }
    }

    checkIfAlreadyAdded(id, array: Array<any>){
      let response: boolean = true;
      for(let elem of array){
        if(elem.id === id){
          response= false;
        }
      }
      return response;
    }

    addAvaliablesServices(values){
      let name;
        for (let vv of this.avaliables_services) {
           if(vv.id == values.avaliables_service_id){
             name = vv.name;
           }
        }

        //console.log(values);

        if(values.avaliables_service_id!=''  && this.checkIfAlreadyAdded(values.avaliables_service_id,this.avaliables_services_add) ){
            this.avaliables_services_add.push({id: values.avaliables_service_id, name});
        }

        // this.avaliables_services_add.push({id: values.avaliables_service_id,name});
        //this.avaliables_services_add = this.avaliables_services_add2;
        //let HOLA1 = Array.from(new Set( this.avaliables_services_add.map((itemInArray) => itemInArray.id ) ) );
        //console.log(HOLA1);
        //this.avaliables_services_add = HOLA1;
    }

    removeItemService(id){
        //this.avaliables_services_add2;
        for (let vv of this.avaliables_services_add) {
           if(vv.id != id){
             this.avaliables_services_add2.push({id: vv.id, name: vv.name});
           }
        }
        this.avaliables_services_add = this.avaliables_services_add2;
        this.avaliables_services_add2 = [];

    }

    addRequest(car_id:string, city_id:string, commune_id:string, address_name:string, address_number:number, address_complement:string, start_time_schedule_requested:string, hora_id:number){
      this.loading = true;
      this.itemsServices = this.avaliables_services_add.map((itemInArray) => itemInArray.id );
      start_time_schedule_requested = start_time_schedule_requested + ' '+CustomComboboxHoras.getHoraId(hora_id);

      this.requestsService.addRequest(car_id, city_id, commune_id, address_name, address_number, address_complement, start_time_schedule_requested,this.itemsServices,this.diagnostics_id)
          .subscribe(result => {
              console.log(result);
              if (result.success === true) {
                  if(result.data.request &&  result.data.request.status === StatusRequestByNames['Requiere Inspección']){
                    this.router.navigate(['pages/solicitar-servicios/']);
                  }
                  else{
                    // register successful
                    //this.modal_title_success = "Registro exitoso";
                    //this.modal_body_success = "Tu solicitud fue creada";
                    //document.getElementById("modal_success_general").click();
                    this.router.navigate(['/pages/solicitar-servicios/step-2-add-requests/'+result.data.id]);
                  }

              } else {
                  // register failed
                  this.error = 'Faild created to requests';
                  this.loading = false;
              }
      });
    }

    goMiRequest(){
      this.router.navigate(['/pages/solicitar-servicios']);
    }

    getRequestsTypes(){
        this.requestsService.getRequestsTypes()
          .subscribe(result => {
              console.log(result);
              if (result.success === true) {

              } else {
                  this.error = 'Fail';
                  this.loading = false;
              }
          });

    }

}
