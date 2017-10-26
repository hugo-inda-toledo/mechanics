import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response, ResponseContentType } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map'

import { AuthenticationService } from '../auth/authentication.service';
import { ServerConfig } from '../app.server.config';
import { Schedule } from '../models/schedule.model';

import { Router } from '@angular/router';

@Injectable()
export class SchedulesService {
    constructor(
        private http: Http,
        private authenticationService: AuthenticationService,
        private router: Router ) {
    }



    get(): Observable<{data:Array<Schedule>}> {
        // add authorization header with jwt token
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        // get users from api
        return this.http.get( ServerConfig.url + '/api/schedules', options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    post(schedules:Array<{ day_of_week:number , start_hour:string, end_hour:string }>): Observable<any> {
      let body = JSON.stringify(schedules);
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/schedules/add';

        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }


}
