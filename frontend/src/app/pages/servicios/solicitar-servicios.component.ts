import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { CarsService } from '../../modelCtlr/cars.service';
import { RequestsService } from '../../modelCtlr/requests.service';
import { Car } from '../../models/car.model';
import { Router } from '@angular/router';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';

import { StatusRequest  } from '../../services/status.requests';

@Component({
  selector: 'solicitar-servicios',
  encapsulation: ViewEncapsulation.None,
  styleUrls: ['./servicios.scss'],
  templateUrl: 'solicitar-servicios.html'
})

export class SolicitarServiciosComponent  implements OnInit  {
    cars : Array<any>;
    requests : Array<any>;

    public isNew = true;
    public loading = false;
    public form:FormGroup;
    public estados: any;

    public request_idd:number;
    public mechanic_idd:number;

    public modal_title_success:string;
    public modal_body_success:string;

    constructor(
      private carsService: CarsService,
      private requestsService: RequestsService,
      public router : Router,
      fb:FormBuilder
    ) {
      this.router = router;
      this.form = fb.group({
            'score':        ['', Validators.compose([Validators.required])],
            'observations': ['', Validators.compose([Validators.nullValidator])]
        });
      this.isNew = false;
      this.estados= StatusRequest;
    }

    ngOnInit() {
      // get cars
      this.getCars();
      this.getRequests();
    }

    getCars(){
      // get cars
      this.carsService.getCars()
        .subscribe(response => {
          if(response && response.data){
          	this.cars = response.data;
            if(this.cars && this.cars.length>0){
              this.isNew = false;
            }
          }
        });
    }
    getRequests(){
      // get cars
      this.requestsService.getAllRequests()
        .subscribe(response => {
          if(response && response.data){
            this.requests = response.data;
          }
        });
    }
    addRequest(){
        this.router.navigateByUrl('/pages/solicitar-servicios/add-requests');
    }

    helpMyProblem(){
      this.router.navigateByUrl('/pages/solicitar-servicios/help-me-requests');
    }

    addCar(){
    	this.router.navigateByUrl('/pages/mi-garage/add-car');
    }

    cancelRequest(request_id){
      this.requestsService.deleteRequest(request_id)
        .subscribe(response=>{
          console.log(response);
          if(response && response.data){

          }
        }, error=>{
          console.log(error);
        });
    }

}
