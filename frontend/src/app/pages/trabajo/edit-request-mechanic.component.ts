import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import { Router, Params } from '@angular/router';
import { ActivatedRoute } from '@angular/router';

import { ApiRestService } from '../../services/api.rest.service';
import { RequestsService } from '../../modelCtlr/requests.service';
import { RequestsMechanicModsService } from '../../modelCtlr/requests_mechanic_mods.service';

//import { CustomComboboxHoras } from '../../services/custom.init.inputs';

@Component({
  selector: 'edit-request-mechanic',
  providers: [ApiRestService],
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'edit-request-mechanic.html'
})

export class EditRequestMechanicComponent implements OnInit {
    loading = false;
    error = '';
    request: any;
    ID: string;

    private sub: any;
    public requests_types : Array<any>;
    public avaliables_services : Array<any>;
    public avaliables_services_add : Array<any> = [];
    public avaliables_services_add2 : Array<any> = [];
    public available_services_original_id : Array<any> = [];
    public router: Router;
    public form:FormGroup;

    public total_price:AbstractControl;
    public start_time_schedule_requested:AbstractControl;
    public type_documents_payment:AbstractControl;
    public avaliables_service_id:AbstractControl;
    public hora_id:AbstractControl;
    public diagnostics_id: number = 0;

    //public horas: Array<any> = CustomComboboxHoras.values;

    public modal_title_success:string;
    public modal_body_success:string;

    constructor(
        private requestsService: RequestsService,
        private requestsMechanicModsService: RequestsMechanicModsService,
        router:Router,
        fb:FormBuilder,
        private activatedRoute: ActivatedRoute,
        private api: ApiRestService
      ) {
        this.router = router;
        this.form = fb.group({
            'start_time_schedule_requested': ['', Validators.required],
            'hora_id': ['', Validators.required],
            'avaliables_service_id'        : ['', this.check.bind(this) ],
        });

        this.start_time_schedule_requested = this.form.controls['start_time_schedule_requested'];
        this.avaliables_service_id         = this.form.controls['avaliables_service_id'];
        this.hora_id                       = this.form.controls['hora_id'];
    }

    public onSubmit(values:any):void {
        if(this.avaliables_services_add.length>0){
            let itemsServices:Array<any> = this.avaliables_services_add.map((itemInArray) => itemInArray.id );
            //this.requestsService.editByMechanic(this.request.id, itemsServices).subscribe( response =>{
            this.requestsMechanicModsService.add(this.request.id, itemsServices).subscribe( response =>{
              // register successful
              this.modal_title_success = "Registro exitoso";
              this.modal_body_success = "Se ha sido modificado la solicitud exitosamente. Advertencia: El cliente debe aceptar estos cambios antes que sean efectivos.";
              document.getElementById("modal_success_general").click();

            }, error=>{
              console.log(error);
            });

        }else{
          console.log('debe seleccionar el servicio');
        }
    }

    goBack(){
      this.router.navigate(['/pages/trabajo']);
    }

    ngOnInit() {
          this.requestsService.getRequestsTypes()
            .subscribe(response => {
                this.requests_types = response.data;
          });

         // get ID
         this.activatedRoute.params.subscribe((params: Params) => {
                 this.ID = params['id'] || null;
         });


         // work data
         this.api.get('/api/requests/showwork/'+this.ID).subscribe((data) =>{
             if(data.success){
               this.request = data.data;

               this.available_services_original_id = this.request.available_services.filter(c=> c._joinData.active).map(c=> c.id);

               for(let itemMod of this.request.requests_mechanic_mods){
                 if(itemMod.status !== 3){
                   this.available_services_original_id = this.available_services_original_id.concat( itemMod.available_services.map(c =>c .id));
                 }
               }


               console.log(this.available_services_original_id);
             }
         });

         this.requestsMechanicModsService.get(this.ID).subscribe((data)=>{
           console.log(data);
         }, error=>{
           console.log(error);
         });



    }


    onChangeRequestsTypes(requestsTypesChoosed: string){
      this.requestsService.getByRequestsTypes(requestsTypesChoosed)
          .subscribe(response => {
              this.avaliables_services = response.data;
          });
    }


    checkIfAlreadyAddedWithId(id, array: Array<any>){
      let response: boolean = false;
      for(let elem of array){
        if( String(elem.id) ===  String(id)  || String(elem) ===  String(id) ){
          response= true;
        }
      }

      return response;
    }

    checkIfAlreadyAdded(id, array: Array<any>){
      let response: boolean = false;
      for(let elem of array){
        if( String(elem) ===  String(id)){
          response= true;
        }
      }

      return response;
    }

    check(control: FormControl):any{
     let vm = this;

      if (this.checkIfAlreadyAdded( control.value , this.avaliables_services_add.map(c=>c.id).concat(this.available_services_original_id) ) ) {
        return ({'isAlreadyAdded':true});
      }
      else if(control.value === '' || control.value === 0){
        return ({'notEmpty': true});
      }
      else{
        return (null)
      }
    }

    addAvaliablesServices(values){
      let name;
        for (let vv of this.avaliables_services) {
           if(vv.id == values.avaliables_service_id){
             name = vv.name;
           }
        }

        if(values.avaliables_service_id!='' && !this.checkIfAlreadyAddedWithId( values.avaliables_service_id , this.avaliables_services_add.concat(this.available_services_original_id)) ){
            this.avaliables_services_add.push({id: values.avaliables_service_id, name});
        }
    }

    removeItemService(id){
        for (let vv of this.avaliables_services_add) {
           if(vv.id != id){
             this.avaliables_services_add2.push({id: vv.id, name: vv.name});
           }
        }
        this.avaliables_services_add = this.avaliables_services_add2;
        this.avaliables_services_add2 = [];
    }

    getRequestsTypes(){
        this.requestsService.getRequestsTypes()
          .subscribe(result => {
              if (result.success === true) {

              } else {
                  this.error = 'Fail';
                  this.loading = false;
              }
          });

    }
}
