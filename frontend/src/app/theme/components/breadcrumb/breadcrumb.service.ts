import {Injectable} from '@angular/core';
import { menuItems } from '../../../app.menu';

@Injectable()
export class BreadcrumbService {

  public getPagesWithNoGoBack(role: number):Array<string> {
    let titlesNoGoBack: Array<string>=[];
    if( role === 5){
      for(let item of menuItems['client']){
        if(item.title.toUpperCase() ==='NECESITO UN SERVICIO'){
          titlesNoGoBack.push('MIS SOLICITUDES');
        }
        else{
          titlesNoGoBack.push(item.title.toUpperCase());
        }

      }
    }
    else{
      for(let item of menuItems['mechanic']){
        if(item.title.toUpperCase() ==='TRABAJO'){
          titlesNoGoBack.push('MI TRABAJO');
        }
        else{
          titlesNoGoBack.push(item.title.toUpperCase());
        }
      }
    }

    return titlesNoGoBack;
  }

}
