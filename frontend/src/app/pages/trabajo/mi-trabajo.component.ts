import { Component, OnInit } from '@angular/core';
import  { Router, ActivatedRoute, Params} from '@angular/router';
//import { Request } from '../../models/request.model';

// test api service
import { ApiRestService } from '../../services/api.rest.service';
import { StatusRequest } from '../../services/status.requests';

@Component({
  selector: 'mi-trabajo',
  providers: [ApiRestService],
  templateUrl: 'mi-trabajo.html'
})

export class MiTrabajoComponent implements OnInit {

  public ID: number;
  public getStatus = StatusRequest;
  public request = null;

  constructor(private api: ApiRestService, private activatedRoute: ActivatedRoute) {
  }

  // cuando carga todos los elementos
  ngOnInit() {

    // get ID
    this.activatedRoute.params.subscribe((params: Params) => {
            this.ID = params['id'] || null;
    });


    // work data
    this.api.get('/api/requests/showwork/'+this.ID).subscribe((data) =>{
        if(data.success){
          this.request = data.data;
          //console.log(data);
        }
    })
  }

}
