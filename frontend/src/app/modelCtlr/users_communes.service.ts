import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map'

import { Router } from '@angular/router';

import { AuthenticationService } from '../auth/authentication.service';
import { ServerConfig } from '../app.server.config';

@Injectable()
export class UsersCommunesService {
    constructor(
        private http: Http,
        private router: Router,
        private authenticationService: AuthenticationService) {
    }

    get(): Observable<any>{
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json' });
        let options = new RequestOptions({ headers: headers });

        return this.http.get( ServerConfig.url + '/api/users_communes', options)
            .map((response: Response) => response.json())
            .catch((error) => {
              return Observable.throw(error);
            });
    }

    post(communes: Array<any>): Observable<any> {
      let body = JSON.stringify(communes);
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/users_communes/add';

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
