import { Injectable } from '@angular/core';
import { Router, CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';

@Injectable()
export class AuthGuard implements CanActivate {

    constructor(private router: Router) { }

    canActivate( route: ActivatedRouteSnapshot, state: RouterStateSnapshot ): boolean  {
        let roles = route.data["roles"] as Array<string>;


        if(localStorage.getItem('currentUser')){
          let currentUser : { email  : string,  token: string, role: string }  = JSON.parse(localStorage.getItem('currentUser'));

          //No se requiere algun rol especifico
          if(typeof roles === 'undefined'){
            return true;
          }

          //Se requiere un rol especifico y el usuario lo tiene
          if(roles && roles.indexOf( String( currentUser.role) ) !== -1 ){
            return true;
          }
          //Se requiere un rol especifico y el usuario NO lo tiene
          else{
            this.router.navigate(['/login']);
            return false;
          }
        }

        //No logeado
        this.router.navigate(['/login'], { queryParams: { returnUrl: state.url }});
        return false;
    }
}
