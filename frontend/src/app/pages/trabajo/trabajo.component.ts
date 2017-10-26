import { Component, ViewEncapsulation, OnInit } from '@angular/core';

import { RequestsService } from '../../modelCtlr/requests.service';
import { Request } from '../../models/request.model';

@Component({
  selector: 'trabajo',
  encapsulation: ViewEncapsulation.None,
  styleUrls: ['./trabajo.scss'],
  templateUrl: 'trabajo.html'
})

export class TrabajoComponent implements OnInit{
  public requests: Array<Request>;
  constructor(
    private requestsService: RequestsService
  ){}

  ngOnInit(){
    /*this.requestsService.getAllRequests({ 'mechanic_id' : 2 })
      .subscribe(response => {
        this.requests = response.data;
      });
   */
  }

}
