import {Component, ViewEncapsulation} from '@angular/core';

import {AppState} from '../../../app.state';

import {AuthenticationService} from '../../../auth/authentication.service';
import { Router } from '@angular/router';

@Component({
    selector:'navbar',
    encapsulation: ViewEncapsulation.None,
    styleUrls: ['./navbar.scss'],
    templateUrl: './navbar.html'
})

export class Navbar{
    public isMenuCollapsed:boolean = false;
    user: any;

    constructor(
      private _state:AppState ,
      public authService: AuthenticationService,
      public router : Router) {
        this.authService= authService;
        this.router = router;
        this._state.subscribe('menu.isCollapsed', (isCollapsed) => {
            this.isMenuCollapsed = isCollapsed;
        });

        //Rol de usuario
        this.user= this.authService.getUser();
    }

    public toggleMenu() {
        this.isMenuCollapsed = !this.isMenuCollapsed;
        this._state.notifyDataChanged('menu.isCollapsed', this.isMenuCollapsed);
    }

    logout(){
      this.authService.logout();
      this.router.navigateByUrl('/login');
    }

    goMiPerfil(){
      this.router.navigateByUrl('/pages/mi-perfil');
    }

    goHomePage(){
      if(this.user.role===5){
        this.router.navigate(['/pages/solicitar-servicios']);
      }
      else{
        this.router.navigate(['/pages/trabajo']);
      }
    }
}
