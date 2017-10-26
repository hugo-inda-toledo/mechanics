import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response, ResponseContentType } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map'

import { AuthenticationService } from '../auth/authentication.service';
import { ServerConfig } from '../app.server.config';
import { Car } from '../models/car.model';

import { Router } from '@angular/router';

@Injectable()
export class RequestsMechanicModsService {
    constructor(
        private http: Http,
        private authenticationService: AuthenticationService,
        private router: Router ) {
    }


    getAll(): Observable<any> {
        // add authorization header with jwt token
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        // get users from api
        return this.http.get( ServerConfig.url + '/api/requests_mechanic_mods/', options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    get(id:string): Observable<any> {
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        // get users from api
        return this.http.get( ServerConfig.url + '/api/requests_mechanic_mods/index/' + id, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    add( request_id: string, itemsServices:Array<any> ): Observable<any> {
      let body = JSON.stringify({request_id, itemsServices});
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/requests_mechanic_mods/add';

        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    /*edit(id: number, car_brand_id:number, car_model_id:number, year:number, patent:string, mileage:number, observations:string): Observable<any> {
      let body = JSON.stringify({
          'car_brand_id': car_brand_id,
          'car_model_id': car_model_id,
          'year': year,
          'patent': patent,
          'mileage': mileage,
          'observations': observations
        });
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/cars/edit/'+ id;

        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    delete(id: number): Observable<any> {
      let body = JSON.stringify({
          'id': id
        });
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/cars/delete/'+ id;

        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }*/


}
