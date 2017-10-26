import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response, ResponseContentType } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map'

import { AuthenticationService } from '../auth/authentication.service';
import { ServerConfig } from '../app.server.config';
import { Car } from '../models/car.model';

import { Router } from '@angular/router';

@Injectable()
export class CarsService {
    constructor(
        private http: Http,
        private authenticationService: AuthenticationService,
        private router: Router ) {
    }

    getCars(): Observable<any>/*<Car[]>*/ {
        // add authorization header with jwt token
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        // get users from api
        return this.http.get( ServerConfig.url + '/api/cars', options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    getCar(id:number): Observable<any>/*<Car[]>*/ {
        // add authorization header with jwt token
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        // get users from api
        return this.http.get( ServerConfig.url + '/api/cars/view/' + id, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    //add car
    addCar(car_brand_id:number, car_model_id:number, year:number, patent:string, mileage:number, observations:string): Observable<any> {
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
      let url=  ServerConfig.url + '/api/cars/add';

        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    //edit car
    editCar(id: number, car_brand_id:number, car_model_id:number, year:number, patent:string, mileage:number, observations:string): Observable<any> {
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

    //eliminar car (dar de baja)
    deleteCar(id: number): Observable<any> {
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
    }

    //calificar mecanico
    QualificationsMechanic(request_id:number, mechanic_id:number,score:number,observations:string): Observable<any> {
      let body = JSON.stringify({
          'request_id': request_id,
          'mechanic_id': mechanic_id,
          'score': score,
          'observations': observations
        });
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/qualifications_to_mechanics/add';

        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    //reporte slud
    ReportsHealth(car_id:number,request_id:number): Observable<any> {
      let body = JSON.stringify({
          'request_id': request_id,
        });
      //let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      //let headers = new Headers({ 'Authorization': 'Bearer ' + this.authenticationService.token });
      let headers = new Headers({ responseType: ResponseContentType.Blob,'Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/reports/health/'+car_id+'/'+request_id;

        return this.http.get( url, options)
            .map((response: Response) => response)
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }


}
