import { Injectable } from '@angular/core';
import { Http, Headers, Response, RequestOptions } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map';

import { ServerConfig } from '../app.server.config';

@Injectable()
export class AuthenticationService {
    public token: string;
    public role : string;
    public name: string;
    public last_name:string;

    constructor(private http: Http) {
        this.getUser();
    }

    getToken(){
      return this.token;
    };

    getUser(): { token: string, role: string, email: string } {
      let currentUser = JSON.parse(localStorage.getItem('currentUser'));
      this.token = currentUser && currentUser.token;
      this.role = currentUser && currentUser.role;
      this.name = currentUser && currentUser.name;
      this.last_name = currentUser && currentUser.last_name;

      return currentUser;
    }

    login(email: string, password: string): Observable<boolean> {


      let body = JSON.stringify({ 'email': email, 'password': password });
      let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json'});
      let options = new RequestOptions({ headers: headers });
      let url=  ServerConfig.url + '/api/users/token';

        return this.http.post( url, body, options)
            .map((response: Response) => {
                // login successful if there's a jwt token in the response
                let token = response.json() && response.json().data && response.json().data.token;
                let role = response.json() && response.json().data && response.json().data.role;
                let name = response.json() && response.json().data && response.json().data.name;
                let last_name = response.json() && response.json().data && response.json().data.last_name;
                if (token) {
                    // set token property
                    this.token = token;

                    // store username and jwt token in local storage to keep user logged in between page refreshes
                    localStorage.setItem('currentUser', JSON.stringify({ email, token, role, name, last_name }));

                    // return true to indicate successful login
                    return true;
                } else {
                    // return false to indicate failed login
                    return false;
                }
            }).catch((error: any) => {
                  console.log(error);
                  return Observable.throw(error);
            });
    }

    logout(): void {
        // clear token remove user from local storage to log user out
        this.token = null;
        localStorage.removeItem('currentUser');
    }
}
