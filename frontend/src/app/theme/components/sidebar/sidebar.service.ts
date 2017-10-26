import {Injectable} from '@angular/core';
import {menuItems} from '../../../app.menu';

@Injectable()
export class SidebarService {

  public getMenuItemsByRole(role: string):Array<Object> {
    if( role == '5'){
      return menuItems['client'];
    }
    else{
      return menuItems['mechanic'];
    }
  }

}
