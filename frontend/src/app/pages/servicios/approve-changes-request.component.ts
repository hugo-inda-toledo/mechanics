import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { RequestsService } from '../../modelCtlr/requests.service';
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';

import { StatusRequest  } from '../../services/status.requests';

@Component({
  selector: 'approve-changes-request',
  encapsulation: ViewEncapsulation.None,
  styleUrls: ['./servicios.scss'],
  templateUrl: 'approve-changes-request.html'
})

export class ApproveChangesRequestComponent  implements OnInit  {
    request : any;
    sumPricePendientes: number;

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

    public modalInfo: { title: string, body: string , fnClick: any } = null;

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

      this.modalInfo={
        title: 'Rechazar cambios',
        body: 'Está a punto de rechazar los cambios. Cuando lo haga solo aparecerán los servicios anteriormente aprobados.',
        fnClick: ()=>{
          let list_id_mods= _self.request.requests_mechanic_mods.filter(c => c.status === 1).map(c=>c.id);
          _self.requestsService.refuseChanges(_self.id, list_id_mods).subscribe(response=>{
            console.log(response);
            _self.router.navigate(['/pages/solicitar-servicios']);
          }, error=>{
            console.log(error);
          });
        }
      };
    }

    getRequests(request_id : number ){
      this.requestsService.getRequests(request_id)
        .subscribe(response => {
          if(response && response.data){
            this.request = response.data;
            this.sumPricePendientes= this.request.requests_mechanic_mods
                                        .filter(c => c.status === 1)
                                        .map(c => c.total_price)
                                        .reduce((sum, current) => sum + current, 0);
          }
        });
    }


    approveChanges(){
        let list_id_mods=[];
        list_id_mods= this.request.requests_mechanic_mods.filter(c => c.status === 1).map(c=>c.id);

        this.requestsService.approveChanges(this.id, list_id_mods).subscribe(response=>{
          console.log(response);
          this.router.navigate(['/pages/solicitar-servicios/step-2-add-requests/'+ this.request.id]);
        }, error=>{
          console.log(error);
        });
    }

    cancelChanges(){
      document.getElementById("openModalButton").click();

    }

}
