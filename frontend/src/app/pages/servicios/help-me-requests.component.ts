import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { CarsService } from '../../modelCtlr/cars.service';
import { RequestsService } from '../../modelCtlr/requests.service';
import { Car } from '../../models/car.model';
import { Request } from '../../models/request.model';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import { Router } from '@angular/router';
import { Location } from '@angular/common';

import { UsersService } from '../../modelCtlr/users.service';
import { CitiesService } from '../../modelCtlr/cities.service';
import { CommunesService } from '../../modelCtlr/communes.service';

import { ApiRestService } from '../../services/api.rest.service';

import { Commune } from '../../models/commune.model';
import { City } from '../../models/city.model';


@Component({
  selector: 'help-me-requests',
  // encapsulation: ViewEncapsulation.None,
  providers: [ApiRestService],
  templateUrl: 'help-me-requests.html'
})

export class HelpMeRequestsComponent implements OnInit {
    loading = false;
    error = '';
    cars : Array<any>;
    requests : Array<any>;
    public diagnostics_id : number;
    public current_request: Object = {};
    public where_list: Array<any>;
    public whatsup_list: Array<any>;
    public when_list: Array<any>= [ {'id': '', 'name': ''} ];
    public situation_list: Array<any>= [ {'id': '', 'name': ''} ];
    public how_often_list: Array<any>= [ {'id': '', 'name': ''} ];

    public router: Router;
    public form:FormGroup;

    public helps_where_id:AbstractControl;
    public helps_whatsup_id:AbstractControl;
    public helps_when_id:AbstractControl;
    public helps_situation_id:AbstractControl;
    public helps_how_often_id:AbstractControl;


    public modal_title_success:string;
    public modal_body_success:string;

    constructor(
        private carsService: CarsService,
        private requestsService: RequestsService,
        router:Router,
        fb:FormBuilder,
        private _location: Location,
        private usersService: UsersService,
        private api: ApiRestService
      ) {
        this.router = router;
        this.form = fb.group({
            'helps_where_id':     ['', Validators.required],
            'helps_whatsup_id':   ['', Validators.required],
            'helps_when_id':      ['', Validators.required],
            'helps_situation_id': ['', Validators.required],
            'helps_how_often_id': ['', Validators.required]
        });

        this.helps_where_id     = this.form.controls['helps_where_id'];
        this.helps_whatsup_id   = this.form.controls['helps_whatsup_id'];
        this.helps_when_id      = this.form.controls['helps_when_id'];
        this.helps_situation_id = this.form.controls['helps_situation_id'];
        this.helps_how_often_id = this.form.controls['helps_how_often_id'];

    }

    public onSubmit(values:any):void {
        if (this.form.valid) {
            let datos = JSON.stringify({
                  'helps_where_id': values.helps_where_id,
                  'helps_whatsup_id': values.helps_whatsup_id,
                  'helps_when_id': values.helps_when_id,
                  'helps_situation_id': values.helps_situation_id,
                  'helps_how_often_id': values.helps_how_often_id
                });
            this.api.post('/api/diagnostics/add',datos).subscribe((data) =>{
            if(data.success && data.data && data.data.id>0){
                  this.diagnostics_id = data.data.id;
                  // console.log(data.data);
                  console.log({'diagnostics_id':data.data.id});
                  this.router.navigate(['/pages/solicitar-servicios/add-requests-d/'+data.data.id]);

                }
            });
        }
    }

    ngOnInit() {
        this.api.get('/api/helps_wheres').subscribe((data) =>{
        if(data.success && data.data && data.data.length>0){
              this.where_list = data.data;
            }
        });
    }





    onChangeWheres(indice:number){226381590/227427331
        this.whatsup_list = [];
        this.when_list = [];
        this.situation_list = [];
        this.how_often_list = [];
        this.clearInput(['helps_whatsup_id','helps_when_id','helps_situation_id','helps_how_often_id']);
        for(let item of this.where_list){
            if(item.helps_whatsups){
                for(let item2 of item.helps_whatsups){
                    if(item2.helps_where_id==indice){
                       this.whatsup_list.push({'id':item2.id,'whatsup_name':item2.whatsup_name,'helps_whens':item2.helps_whens});
                    }
                }
            }
        }
        /*this.api.get('/api/helps_whatsups/index/'+indice).subscribe((data) =>{
        if(data.success && data.data && data.data.length>0){
              this.whatsup_list = data.data;
            }
        });*/
    }

    onChangeWhatsups(indice:number){
        this.when_list = [];
        this.situation_list = [];
        this.how_often_list = [];
        this.clearInput(['helps_when_id','helps_situation_id','helps_how_often_id']);
        // this.form.get('helps_when_id').markAsPristine();
        // this.form.get('helps_situation_id').markAsPristine();
        // this.form.get('helps_how_often_id').markAsPristine();

        for(let item of this.whatsup_list){
            if(item.helps_whens){
                for(let item2 of item.helps_whens){
                    if(item2.helps_whatsup_id==indice){
                       this.when_list.push({'id':item2.id,'when_name':item2.when_name,'helps_situations':item2.helps_situations});
                    }
                }
            }
        }
        // this.api.get('/api/helps_whens/index/'+indice).subscribe((data) =>{
        // if(data.success && data.data && data.data.length>0){
        //       this.when_list = data.data;
        //     }
        // });
    }

    onChangeWhens(indice:number){
        this.situation_list = [];
        this.how_often_list = [];
        this.clearInput(['helps_situation_id','helps_how_often_id']);
        for(let item of this.when_list){
            if(item.helps_situations){
                for(let item2 of item.helps_situations){
                    if(item2.helps_when_id==indice){
                       this.situation_list.push({'id':item2.id,'situation_name':item2.situation_name,'helps_how_oftens':item2.helps_how_oftens});
                    }
                }
            }
        }
        // this.api.get('/api/helps_situations/index/'+indice).subscribe((data) =>{
        // if(data.success && data.data && data.data.length>0){
        //       this.situation_list = data.data;
        //     }
        // });
    }

    onChangeSituations(indice:number){
        this.how_often_list = [];
        this.clearInput(['helps_how_often_id']);
        for(let item of this.situation_list){
            if(item.helps_how_oftens){
                for(let item2 of item.helps_how_oftens){
                    if(item2.helps_situation_id==indice){
                       this.how_often_list.push({'id':item2.id,'how_often_name':item2.how_often_name});
                    }
                }
            }
        }
        // this.api.get('/api/helps_how_oftens/index/'+indice).subscribe((data) =>{
        // if(data.success && data.data && data.data.length>0){
        //       this.how_often_list = data.data;
        //     }
        // });
    }

    clearInput(nameInputs:Array<any>){
        for(let input of nameInputs){
            this[input].setValue(null);
            this.form.get(input).markAsPristine();
            // this[input].setError(null);
        }
    }

    backClicked() {
        this._location.back();
    }

    goMiRequest(){
      this.router.navigate(['/pages/solicitar-servicios']);
    }


}
