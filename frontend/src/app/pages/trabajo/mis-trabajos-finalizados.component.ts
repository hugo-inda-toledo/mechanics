import { Component, OnInit } from '@angular/core';
import { Request } from '../../models/request.model';

// test api service
import { ApiRestService } from '../../services/api.rest.service';
import { StatusRequest } from '../../services/status.requests';

@Component({
  selector: 'mis-trabajos-finalizados',
  //encapsulation: ViewEncapsulation.None,
  providers: [ApiRestService],
  templateUrl: 'mis-trabajos-finalizados.html'
})

export class MisTrabajosFinalizadosComponent implements OnInit {

  public getStatus = StatusRequest;
  public old_requests: Array<any> = [];

  constructor(private api: ApiRestService) {
  }

  ngOnInit() {
    // old works
    this.api.get('/api/requests/myworks').subscribe((data) =>{
        if(data.success){
          this.old_requests = data.data;
          // console.log(data);
        }
    });
  }

}
