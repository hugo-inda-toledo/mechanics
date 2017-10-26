import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response, ResponseContentType } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map'

import { AuthenticationService } from '../auth/authentication.service';
import { ServerConfig } from '../app.server.config';
import { Car } from '../models/car.model';
import { Request } from '../models/request.model';

import { Router } from '@angular/router';

@Injectable()
export class RequestsService {
    constructor(
        private http: Http,
        private authenticationService: AuthenticationService,
        private router: Router ) {
    }

    getAllRequests(filter: any = null): Observable<any>{
        // add authorization header with jwt token
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        let optionalParams= '';

        if(filter){
          optionalParams='?';
          for(let index in filter){
            optionalParams+= index+ '='+ filter[index];
          }
        }

        // get users from api
        return this.http.get( ServerConfig.url + '/api/requests'+ optionalParams, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    //car_id, city_id, commune_id, address_name, address_number, address_complement, start_time_schedule_requested,itemsServices)
    addRequest(car_id:string, city_id:string, commune_id:string, address_name:string, address_number:number, address_complement:string, start_time_schedule_requested:string,itemsServices:Array<any>,diagnostics_id:number): Observable<any> {
      let body = JSON.stringify({
          'car_id': car_id,
          'city_id': city_id,
          'commune_id': commune_id,
          'address_name': address_name,
          'address_number': address_number,
          'address_complement': address_complement,
          'start_time_schedule_requested': start_time_schedule_requested,
          'itemsServices': itemsServices,
          'diagnostics_id': diagnostics_id
        });
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/requests/add';

        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    Step2addRequest(request_id:number, requests_types_id:string, type_document:string,total_price:number): Observable<any> {
      let body = JSON.stringify({
          'requests_types_id': requests_types_id,
          'type_documents_payment': type_document,
          'action': 'changeDocument',
          'total_price': total_price
        });
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/requests/edit/'+request_id;


        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    approveChanges(request_id:number, mods: Array<string>): Observable<any> {
      let body = JSON.stringify({
          'action': 'approveChanges',
          'itemsMods': mods
        });
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/requests/edit/'+request_id;


        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    refuseChanges(request_id:number , mods: Array<string> ): Observable<any> {
      let body = JSON.stringify({
          'action': 'refuseChanges',
          'itemsMods': mods
        });
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/requests/edit/'+request_id;


        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    addInvoice(full_name:string, address:string, rut:string, giro:string,request_id:number, total_price:number, id_type_payment:number): Observable<any> {
      let body = JSON.stringify({
          'request_id': request_id,
          'full_name': full_name,
          'address': address,
          'rut': rut,
          'giro': giro,
          'total_price': total_price,
          'payment_method_id': id_type_payment,
        });
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/invoices/add';

        return this.http.post( url, body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    deleteRequest(id: string): Observable<any> {
      let body = JSON.stringify({
          'id': id
        });
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json','Authorization': 'Bearer ' + this.authenticationService.token });
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/requests/delete/'+ id;

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


    getRequestsTypes(): Observable<any> {
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        return this.http.get( ServerConfig.url + '/api/requests_types/index', options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    getByRequestsTypes(requestsTypeId: string): Observable<any>{
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        return this.http.get( ServerConfig.url + '/api/available_services/index/' + requestsTypeId, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    getRequests(id: number): Observable<any>{
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        return this.http.get( ServerConfig.url + '/api/requests/view/' + id, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    getPaymentMethods(): Observable<any>{
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        return this.http.get( ServerConfig.url + '/api/payment_methods/index', options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }

    getPayments(id: number): Observable<any>{
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token });
        let options = new RequestOptions({ headers: headers });

        return this.http.get( ServerConfig.url + '/api/payments/view/' + id, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              if(error && JSON.parse(error._body).message === 'Expired token'){
                this.router.navigateByUrl('/login');
              }
              return Observable.throw(error);
            });
    }




}
