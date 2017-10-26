import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import { Router } from '@angular/router';
import { Location } from '@angular/common';
import { ActivatedRoute } from '@angular/router';

import { ServerConfig } from '../../app.server.config';

import { RequestsService } from '../../modelCtlr/requests.service';
import { Request } from '../../models/request.model';

@Component({
  selector: 'webpay-rejection',
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'webpay-rejection.html'
})

export class WebpayRejectionComponent implements OnInit {
    loading = false;
    error = '';
    requests : Array<any>;
    payments : Array<any>;
    private sub: any;
    public token_url: string;
    public id: number;
    public router: Router;
    public form:FormGroup;

    public modal_title_success:string;
    public modal_body_success:string;

    constructor(
        private requestsService: RequestsService,
        router:Router,
        fb:FormBuilder,
        private _location: Location,
        private activateRoute: ActivatedRoute
      ) {
        this.router = router;
    }

    ngOnInit() {
        let _self= this;
        this.sub = this.activateRoute.params.subscribe(params => {
         _self.id = +params['id']; // (+) converts string 'id' to a number
         _self.getPayments(_self.id);
      });
    }

    getPayments(id:number){
      this.requestsService.getPayments(id)
          .subscribe(result => {
              console.log(result);
              if (result.success === true) {
                this.payments = result.data;
                console.log(result.data);
              }
          });
    }

    goMiRequest(){
      this.router.navigate(['/pages/solicitar-servicios']);
    }

}
