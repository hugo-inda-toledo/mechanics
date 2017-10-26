import { Component, ViewEncapsulation, OnInit } from '@angular/core';

import { MyToastService } from '../../services/toast.service';
import { SchedulesService } from '../../modelCtlr/schedules.service';
import { Schedule } from '../../models/schedule.model';

import * as moment from 'moment/moment';

@Component({
  selector: 'horarios',
  encapsulation: ViewEncapsulation.None,
  templateUrl: './horarios.html',
  styleUrls: ['./horarios.scss']
})

export class HorariosComponent implements OnInit{
  public canEdit:boolean =false;
  public schedules:Array<Schedule>=[];
  public newSchedules:Array<{ day_of_week:number , start_hour:string, end_hour:string }>=[];

  public days: Array<string> = [ 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
  public hours: Array<string>=['06:00', '07:00','08:00', '09:00','10:00', '11:00','12:00', '13:00','14:00', '15:00','16:00', '17:00','18:00', '19:00','20:00', '21:00','23:00'];
  public hoursEnd: Array<string>=['07:00','08:00', '09:00','10:00', '11:00','12:00', '13:00','14:00', '15:00','16:00', '17:00','18:00', '19:00','20:00', '21:00','23:00','24:00'];
  public scheduleAvailable: any = {};

  constructor(
    private schedulesService: SchedulesService,
    private myToastService: MyToastService){}

  ngOnInit(){
    this.schedulesService.get()
    .subscribe(response=>{
      this.schedules = response.data;

      for(let schedule of this.schedules){
        let init = moment(schedule.start_hour,'YYYY MM DD HH:mm:ss ZZ');
        let end= moment(schedule.end_hour,'YYYY MM DD HH:mm:ss ZZ');
        let dayOfTheWeek= this.days[schedule.day_of_week];

        if(init.isBefore(end)){
          for(let ite= moment(init); !ite.isAfter(end); ite.add(1, 'hours')){
            this.addHour( dayOfTheWeek, ite.utc().format('HH:mm') );
          }
        }
        else{
          this.addHour( this.days[schedule.day_of_week], init.utc().format('HH:mm') );
        }

      }
    });
  }

  addHour(day, hour){
    if(!this.scheduleAvailable[day]){
      this.scheduleAvailable[day]={};
      this.scheduleAvailable[day][hour]=true;
    }
    else{
      if(this.scheduleAvailable[day][hour]=== true){
        delete this.scheduleAvailable[day][hour];
      }
      else{
        this.scheduleAvailable[day][hour] = true;
      }
    }
  }

  clickOnHour(day, hour){
    if(this.canEdit){
      this.addHour(day,hour);
    }
  }

  activateEdit(){
    this.canEdit = !this.canEdit;
  }


  fillZeros(input, lengthToFill, side:string = 'left') {

  	let output:string ='';
    let fill:string='';

  	//Se genera string de relleno
  	if(input && lengthToFill){
  		for (let i = lengthToFill - input.toString().length; i > 0; --i) {
  			fill = fill.valueOf() + '0';
  		}
  	}

  	//Se rellena con caracteres dependiendo del lado escogido
  	if(side){
  		if(side === 'right'){
  			output = input.toString() + fill.valueOf();
  		}
  		else if(side === 'left'){
  			output= fill.valueOf() + input.toString();
  		}
  	}

     return output;
  }

  onSubmit(){
    //console.log(this.scheduleAvailable);
    this.newSchedules=[];
    for(let key in this.scheduleAvailable){
      let init=null;
      let end= null;
      let index=0;
      for(let keyHour of this.hours){
        if(this.scheduleAvailable[key] && this.scheduleAvailable[key][keyHour]){
            console.log(key + ' '+keyHour);

            //Primer bloque
            if(init === null){
              init= parseInt(keyHour);
              end= parseInt(keyHour);
              //console.log('primer bloque '+ init);
            }
            //Si hay horarios continuos
            else if(end !== null && parseInt(keyHour) > end && parseInt(keyHour)-end === 1){
              end = parseInt(keyHour);
              //console.log('horarios continuos '+end);

            }

            else if(end !== null &&  parseInt(keyHour) > end && parseInt(keyHour)-end > 1){
              //Agrego bloque con datos iteracion pasada
              //console.log('un bloque completo '+ init + ' ' + end);
              this.newSchedules.push({day_of_week: this.days.indexOf(key) , start_hour: this.fillZeros(init,2) +':00', end_hour: this.fillZeros(end,2) +':00'});

              //Reinicio bloque
              init= parseInt(keyHour);
              end= parseInt(keyHour);
              //console.log('bloque nuevo '+ init);
            }

            //Ultimo o unico elemento del dia
            if(Object.keys(this.scheduleAvailable[key]).length-1 === index ){
              //console.log(Object.keys(this.scheduleAvailable[key]).length-1 + ' ' + index );
              //console.log('un bloque completo '+ init + ' ' + end);
              this.newSchedules.push({day_of_week: this.days.indexOf(key) , start_hour: this.fillZeros(init,2) +':00', end_hour: this.fillZeros(end,2) +':00'});
            }

            index++;
        }
      }
    }//fin for

    //Envio schedules a servidor
    this.schedulesService.post(this.newSchedules)
    .subscribe(response=>{
      console.log(response);
      if(response.success){
        this.activateEdit();
        this.myToastService.addToast('success', { title:'Horario de trabajo', msg:'Se ha modificado el horario con exito'});
      }
    });
  }

}
