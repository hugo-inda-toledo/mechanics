import { Component, ViewEncapsulation } from '@angular/core';
import { Location } from '@angular/common';
import { Router } from '@angular/router';

import { AuthenticationService } from '../../../auth/authentication.service';
import { AppState } from "../../../app.state";

import { BreadcrumbService } from './breadcrumb.service';

@Component({
    selector: 'breadcrumb',
    encapsulation: ViewEncapsulation.None,
    styleUrls: ['./breadcrumb.scss'],
    templateUrl: './breadcrumb.html',
    providers: [BreadcrumbService]
})

export class Breadcrumb {

    public activePageTitle:string = '';
    public customUrlGoGack: string='';

    public showGoBack: boolean= false;
    public roleUser: any;
    public titlesNoGoBack: Array<string>= [];

    constructor(
      private _state:AppState,
      private _location: Location,
      private authService: AuthenticationService,
      private _breadcrumbService:BreadcrumbService,
      private router: Router
    ){
        //Rol de usuario
        this.roleUser= this.authService.getUser().role;
        //Paginas donde no mostrar el volver
        this.titlesNoGoBack= this._breadcrumbService.getPagesWithNoGoBack(this.roleUser);

        this._state.subscribe('menu.activeLink', (activeLink) => {
            //Reseteo custom url go back
            this.customUrlGoGack= '';

            //Mostrar boton volver
            if(this.titlesNoGoBack.indexOf(activeLink.toUpperCase()) === -1){
              this.showGoBack= true;
            }else{
              this.showGoBack= false;
            }

            if (activeLink) {
                this.activePageTitle = activeLink;
            }
        });
    }

    public ngOnInit():void {
        /*if (!this.activePageTitle) {
            this.activePageTitle = 'dashboard';
        }*/

        //ToDo: Si se encuentra activada un hijo, mostrar en menu el padre activado
    }

    backClicked() {
      if(!this.customUrlGoGack){
        this._location.back();
      }
      else{
        this.router.navigate([this.customUrlGoGack]);
      }
    }

}
