import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import { Router } from '@angular/router';
import { Location } from '@angular/common';
import { ActivatedRoute } from '@angular/router';


import { CarsService } from '../../modelCtlr/cars.service';
import { RequestsService } from '../../modelCtlr/requests.service';
import { AuthenticationService } from '../../auth/authentication.service';

import { ServerConfig } from '../../app.server.config';

@Component({
  selector: 'step-2-add-requests',
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'step-2-add-requests.html'
})

export class Step2AddRequestsComponent implements OnInit {
    loading = false;
    error = '';
    cars : Array<any>;

    request : any;
    paymentsMethods : Array<any>;
    usersAddress : Array<any>;
    private sub: any;
    public token_url: string;
    public id: number;
    public requests_types : Array<any>;
    public router: Router;
    public form:FormGroup;
    public car_id:AbstractControl;
    public requests_types_id:AbstractControl;
    public tipo_documento:AbstractControl;
    public type_documents_payment:AbstractControl;
    public total_price:AbstractControl;

    public modal_title_success:string;
    public modal_body_success:string;

    constructor(
        private carsService: CarsService,
        private requestsService: RequestsService,
        private authenticationService: AuthenticationService,
        router:Router,
        fb:FormBuilder,
        private _location: Location,
        private activateRoute: ActivatedRoute
      ) {
        this.router = router;
        this.form = fb.group({
            'requests_types_id': ['1', Validators.required],
            'tipo_documento': ['boleta', Validators.required],
            'total_price': [],
        });

        this.requests_types_id = this.form.controls['requests_types_id'];
        this.tipo_documento = this.form.controls['tipo_documento'];
        this.total_price = this.form.controls['total_price'];

    }

    public onSubmit(values:any):void {
        if (this.form.valid) {
            //this.Step2addRequest(values.requests_types_id, values.tipo_documento);
            console.log(this.id);
            console.log(values);

            if(values.tipo_documento == 'boleta'){
              //ir a modulo de pago
              // guardar/actualizar e ir
              //redireccionar transbank
              this.Step2addRequest(values.requests_types_id, values.tipo_documento, values.total_price);
            }else if(values.tipo_documento == 'factura'){
              //desplegar form datos factura
              this.router.navigate(['/pages/solicitar-servicios/step-3-add-requests/'+this.id+'/'+values.requests_types_id]);
            }
        }
    }

    ngOnInit() {
        let _self= this;
        this.sub = this.activateRoute.params.subscribe(params => {
         _self.id = +params['id']; // (+) converts string 'id' to a number
         _self.getRequests(_self.id);
         this.getPaymentMethods();
      });
    }

    getRequests(id:number){
      this.requestsService.getRequests(id)
          .subscribe(result => {
              console.log(result);
              if (result.success === true) {
                this.request = result.data;

                if(this.request && this.request.status !== 10){
                  this['total_price'].setValue(result.data.total_price);
                }
                else{
                  let result= this.request.requests_mechanic_mods
                                  .filter(c => c.status === 2)
                                  .map(c => c.total_price)
                                  .reduce((sum, current) => sum + current, 0);
                  this['total_price'].setValue( result );
                }

              }
          });
    }


    getPaymentMethods(){
      this.requestsService.getPaymentMethods()
          .subscribe(result => {
              console.log(result);
              if (result.success === true) {
                this.paymentsMethods = result.data;
              }
          });
    }


    Step2addRequest(requests_types_id:string, type_document:string, total_price:number){
      this.loading = true;
      this.requestsService.Step2addRequest(this.id, requests_types_id, type_document, total_price)
          .subscribe(result => {
              console.log(result);
              if (result.success === true) {
                  // register successful
                  this.token_url = this.authenticationService.getToken();
                  window.location.href = ServerConfig.url+'/payments/webpay/'+result.data.payment_id+'/'+this.token_url;
              } else {
                  // register failed
                  this.error = 'Faild created to auto';
                  this.loading = false;
              }
          });
    }

    goMiRequest(){
      this.router.navigate(['/pages/solicitar-servicios']);
    }










}
