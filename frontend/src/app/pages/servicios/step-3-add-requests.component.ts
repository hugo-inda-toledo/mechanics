import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import { Router } from '@angular/router';
import { Location } from '@angular/common';
import { ActivatedRoute } from '@angular/router';

import { ServerConfig } from '../../app.server.config';
import { RequestsService } from '../../modelCtlr/requests.service';
import { AuthenticationService } from '../../auth/authentication.service';


@Component({
  selector: 'step-3-add-requests',
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'step-3-add-requests.html'
})

export class Step3AddRequestsComponent implements OnInit {
    loading = false;
    error = '';

    private sub: any;
    request : any;
    token_url: string;
    id: any;
    id_type_payment:any;

    //form
    public form:FormGroup;
    public car_id:AbstractControl;
    public full_name:AbstractControl;
    public address:AbstractControl;
    public rut:AbstractControl;
    public giro:AbstractControl;
    public total_price:AbstractControl;

    //modal
    public modal_title_success:string;
    public modal_body_success:string;

    constructor(
        private authenticationService: AuthenticationService,
        private requestsService: RequestsService,
        private router:Router,
        fb:FormBuilder,
        private activateRoute: ActivatedRoute
      ) {
        this.form = fb.group({
            'full_name':     ['', Validators.compose([Validators.required, Validators.minLength(3)])],
            'address':       ['', Validators.compose([Validators.required, Validators.minLength(5)])],
            'rut':           ['', Validators.compose([Validators.required, Validators.minLength(10), Validators.maxLength(10)])],
            'giro':          ['', Validators.required],
            'total_price':   [],
        });

        this.full_name = this.form.controls['full_name'];
        this.address   = this.form.controls['address'];
        this.rut       = this.form.controls['rut'];
        this.giro      = this.form.controls['giro'];
        this.total_price = this.form.controls['total_price'];

    }

    public onSubmit(values:any):void {
        if (this.form.valid) {
            this.addInvoice(values.full_name, values.address, values.rut, values.giro);
            console.log(this.id);
            console.log(values);
        }
    }

    ngOnInit() {
        let _self= this;
        this.sub = this.activateRoute.params.subscribe(params => {
         _self.id = +params['id']; // (+) converts string 'id' to a number
         _self.id_type_payment = +params['id_type_payment']; // (+) converts string 'id' to a number
         _self.getRequests(_self.id);
      });
    }

    getRequests(id:number){
      this.requestsService.getRequests(id)
          .subscribe(result => {
              console.log(result);
              if (result.success === true) {
                this.request = result.data;

                if(this.request && this.request.status !== 9){
                  this['total_price'].setValue(this.request.total_price);
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


    addInvoice(full_name:string, address:string, rut:string, giro:string){
      this.loading = true;
      this.requestsService.addInvoice(full_name, address, rut, giro,this.id, this.total_price.value ,this.id_type_payment)
          .subscribe(result => {
              console.log(result);
              if (result.success === true) {
                  // register successful
                  //this.modal_title_success = "Registro exitoso";
                  //this.modal_body_success = "Tu solicitud fue creada";
                  //document.getElementById("modal_success_general").click();
                  //redireccionar a transbank
                  //window.location = '';
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
