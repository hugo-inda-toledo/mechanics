import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map';

import { AuthenticationService } from '../auth/authentication.service';
import { ServerConfig } from '../app.server.config';

import { Router } from '@angular/router';

@Injectable()
export class UsersService {
    constructor(
        private http: Http,
        private authenticationService: AuthenticationService,
        private router: Router ) {}

    register(params: any): Observable<any>{
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json'});
        let options = new RequestOptions({ headers: headers });
        let body= JSON.stringify(params);

        return this.http.post( ServerConfig.url + '/api/users/add', body, options)
            .map((response: Response) => response.json())
            .catch((error) => {
              console.log(error);
              return Observable.throw(error);
            });
    }

    recoverPassword(email: string ): Observable<any>{
        let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json'});
        let options = new RequestOptions({ headers: headers });
        let body= JSON.stringify({email});

        return this.http.post( ServerConfig.url + '/api/users/recover_password', body , options)
            .map((response: Response) => response.json())
            .catch((error) => {
              console.log(error);
              return Observable.throw(error);
            });
    }

    confirmRecoverPassword(hash:string): Observable<any>{
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json'});
      let options = new RequestOptions({ headers: headers });

      return this.http.get( ServerConfig.url + '/api/users/recover_password/'+ hash,  options)
          .map((response: Response) => response.json())
          .catch((error) => {
            console.log(error);
            return Observable.throw(error);
          });
    }

    changePasswordInRecover(token: string, hash: string , newPassword: string): Observable<any>{
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + token});
      let options = new RequestOptions({ headers: headers });
      let body = JSON.stringify({ password: newPassword , hash: hash});

      return this.http.put( ServerConfig.url + '/api/users/recover_password', body, options)
          .map((response: Response) => response.json())
          .catch((error) => {
            if(error && JSON.parse(error._body).message === 'Expired token'){
              this.router.navigateByUrl('/login');
            }
            return Observable.throw(error);
          });
    }

    changePassword(userId: string, oldPassword: string, newPassword: string): Observable<any>{
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token});
      let options = new RequestOptions({ headers: headers });
      let body = JSON.stringify({ password: newPassword , oldpassword: oldPassword});

      return this.http.post( ServerConfig.url + '/api/users/change_password/'+userId, body, options)
          .map((response: Response) => response.json())
          .catch((error) => {
            if(error && JSON.parse(error._body).message === 'Expired token'){
              this.router.navigateByUrl('/login');
            }
            return Observable.throw(error);
          });
    }

    activateAccount(hash:string): Observable<any>{
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json'});
      let options = new RequestOptions({ headers: headers });

      return this.http.get( ServerConfig.url + '/api/users/activated_account/'+ hash,  options)
          .map((response: Response) => response.json())
          .catch((error) => {
            console.log(error);
            return Observable.throw(error);
          });
    }

    get(): Observable<any>{
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token});
      let options = new RequestOptions({ headers: headers });

      return this.http.get( ServerConfig.url + '/api/users/view',  options)
          .map((response: Response) => response.json())
          .catch((error) => {
            if(error && JSON.parse(error._body).message === 'Expired token'){
              this.router.navigateByUrl('/login');
            }
            return Observable.throw(error);
          });
    }

    edit(idUser: string, params: any): Observable<any>{
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authenticationService.token});
      let options = new RequestOptions({ headers: headers });
      let body = JSON.stringify(params);

      return this.http.post( ServerConfig.url + '/api/users/edit/' + idUser, body, options)
          .map((response: Response) => response.json())
          .catch((error) => {
            if(error && JSON.parse(error._body).message === 'Expired token'){
              this.router.navigateByUrl('/login');
            }
            return Observable.throw(error);
          });
    }

}
