// Core
import { Http, Headers, RequestOptions, Response, ResponseContentType } from '@angular/http';
import { Injectable } from '@angular/core';
import { Observable }     from 'rxjs/Observable';
import 'rxjs/add/operator/map';

// Auth services
import { AuthenticationService } from '../auth/authentication.service';

// Router
import { Router } from '@angular/router';

// Server Config
import { ServerConfig } from '../app.server.config';

@Injectable()
export class ApiRestService {

  public showError = true;

  constructor(
    private http: Http,
    private authenticationService: AuthenticationService,
    private router: Router
  ) {}


  private onCatch(res: Response) {

      if (res.status === 401 || res.status === 403) {
        // redirigir al usuario para pedir credenciales
        this.showError ? console.error('No tienes permiso - Fuckoff') : null;
        this.router.navigate(['/login']);
      }
      if(res.status == 400){
          // Bad request
          this.showError ? console.error('Error en la consulta', res) : null;
      }
      if(res && JSON.parse(res['_body']).message === 'Expired token'){
        // Expiró  el TOKEN
        this.showError ? console.info('Token expirado') : null;
        this.router.navigate(['/login']);
      }
      // retorna el error
    //   return Observable.throw(res);
    return Observable.empty();
  }

  // Para get
  get(url: string, tokenRequired: boolean = true): Observable<any> {

    let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json'});
    let options = new RequestOptions({ headers: headers });

    if(tokenRequired){
      headers.append('Authorization','Bearer ' + this.authenticationService.token);
    }

    // Http get
    return this.http.get( ServerConfig.url + url, options)
      .map((response: Response) => response.json())
      .catch((error) => {
        if(error && JSON.parse(error._body).message === 'Expired token'){
          this.router.navigate(['/login']);
        }
        return Observable.throw(error || 'Server Error');
      });
  }

  // Para post
  post(url: string, params: Object = {}, tokenRequired: boolean = true): Observable<any>{
    let headers = new Headers({ 'Content-Type': 'application/json', 'Accept': 'application/json'});
    let options = new RequestOptions({ headers: headers });

    if(tokenRequired){
      headers.append('Authorization','Bearer ' + this.authenticationService.token);
    }

    // Http post
    return this.http.post( ServerConfig.url + url , params, options)
    .map((response: Response) => response.json())
    .catch((error) => {
        return this.onCatch(error);
        // if(error && JSON.parse(error._body).message === 'Expired token'){
        //   this.router.navigate(['/login']);
        // }
        // return Observable.throw(error || 'Server Error');
    });
  }










}
