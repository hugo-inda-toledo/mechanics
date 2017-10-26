import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map'

import { AuthenticationService } from '../auth/authentication.service';
import { ServerConfig } from '../app.server.config';

@Injectable()
export class CommunesService {
    constructor(
        private http: Http,
        private authenticationService: AuthenticationService) {
    }

    getAll(): Observable<any>{
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json' });
        let options = new RequestOptions({ headers: headers });

        return this.http.get( ServerConfig.url + '/api/communes', options)
            .map((response: Response) => response.json())
            .catch((error) => {
              return Observable.throw(error);
            });
    }

    getByCity(cityId: string): Observable<any>{
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json' });
        let options = new RequestOptions({ headers: headers });

        return this.http.get( ServerConfig.url + '/api/communes/index/' + cityId, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              return Observable.throw(error);
            });
    }
}
