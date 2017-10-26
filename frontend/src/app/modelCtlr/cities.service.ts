import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map'

import { AuthenticationService } from '../auth/authentication.service';
import { ServerConfig } from '../app.server.config';

@Injectable()
export class CitiesService {
    constructor(
        private http: Http,
        private authenticationService: AuthenticationService) {
    }

    get(): Observable<any>{
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json' });
        let options = new RequestOptions({ headers: headers });

        return this.http.get( ServerConfig.url + '/api/cities', options)
            .map((response: Response) => response.json())
            .catch((error) => {
              return Observable.throw(error);
            });
    }
}
