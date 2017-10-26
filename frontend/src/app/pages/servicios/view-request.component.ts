import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { RequestsService } from '../../modelCtlr/requests.service';
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';

import { StatusRequest  } from '../../services/status.requests';

@Component({
  selector: 'view-request',
  encapsulation: ViewEncapsulation.None,
  styleUrls: ['./servicios.scss'],
  templateUrl: 'view-request.html'
})

export class ViewRequestComponent  implements OnInit  {
    request : any;

    public isNew = true;
    public loading = false;
    public form:FormGroup;
    public estados: any;

    private sub: any;
    public id: number;

    public request_idd:number;
    public mechanic_idd:number;

    public modal_title_success:string;
    public modal_body_success:string;

    constructor(
      private requestsService: RequestsService,
      public router : Router,
      private activateRoute: ActivatedRoute,
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
      // get car
      let _self= this;
      this.sub = this.activateRoute.params.subscribe(params => {
        console.log(params['id']);
         _self.id = +params['id']; // (+) converts string 'id' to a number
         _self.getRequests(_self.id);
      });
    }

    getRequests(request_id : number ){
      // get cars
      this.requestsService.getRequests(request_id)
        .subscribe(response => {
          if(response && response.data){
            this.request = response.data;
          }
        });
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
