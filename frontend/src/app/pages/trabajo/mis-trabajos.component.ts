import { Component, OnInit, AfterViewInit } from '@angular/core';
import { Request } from '../../models/request.model';
import { Router } from '@angular/router';
import { Observable } from 'rxjs/Observable';

// Request to API
import { ApiRestService } from '../../services/api.rest.service';
import { StatusRequest } from '../../services/status.requests';

// Variables configuracion
import { AppConfig } from '../../app.config';

// Mensajes Toast
import { MyToastService } from '../../services/toast.service';

// Access Jquery
declare var $: any;

@Component({
  selector: 'mis-trabajos',
  //encapsulation: ViewEncapsulation.None,
  templateUrl: 'mis-trabajos.html'
})

export class MisTrabajosComponent implements OnInit, AfterViewInit {

  public getStatus = StatusRequest;
  public request_id: number;
  public current_request: Object;
  public old_requests: Array<Object> = [];
  public cancelList: Array<Object> = [];
  public cancelWork = {subject_id: null, message: '', request_id: null};
  public phone_number;
  // spinner
  public isRequesting: boolean = false;
  public messageRequesting: string = 'Espere un momento por favor...';

  constructor(
    private api: ApiRestService,
    private router: Router,
    private myToast: MyToastService,
    private appConfig: AppConfig
  )
  {
    this.phone_number = appConfig.config.phoneContact;
  }

  // stop spinner
  private stopRefreshing() {
      this.isRequesting = false;
  }

  // objeto esta vacio?
  public isEmptyObject(obj) {
    return (Object.keys(obj).length === 0);
  }

  // revisa si puede comenzar o no un trabajo,
  // siempre y cuando no tengas otro en curso.
  public puedeComenzar(index: number){
      return (index == 0 && !this.current_request) ? true  : false;
  }

  /* Cuando carga todos los elementos de la vista */
  ngOnInit() {
    // datos de trabajos
    this.getWorks();
  }

  ngAfterViewInit(){
      // revisar si hay mensajes pendientes.
      this.myToast.hasMessages();
  }

  public getWorks(hideLoading: boolean = false){
      Observable.forkJoin(
          this.trabajosEnCurso(),
          this.trabajosPendientes())
      .subscribe((res)=>{
          if(res[0].success && res[0].data){
            this.current_request = res[0].data;
          }
          if(res[1].success && res[1].data){
             this.old_requests = res[1].data;
          }
        },
        (error) => {},
        () => {
            if(hideLoading){
                this.stopRefreshing();
            }
        }
     );
 }

  // cargar trabajo actual
  public trabajosEnCurso(){
      return this.api.get('/api/requests/mycurrentwork');
 }
  // // cargar trabajos pendientes
  public trabajosPendientes(){
      return this.api.get('/api/requests/myworks');
  }

  /**
  *
  *     Anular Trabajo
  *
  */
  public anularTrabajoModal(id:number){

    // antes abrir modal, buscar listado de opciones de anulación.
    this.request_id = id;
    this.isRequesting = true;
    this.api.post('/api/request_cancelation_options/getlist')
      .subscribe((response)=>{
          // datos para select
          if(response && response.success){
              this.cancelList = [{description: 'Seleccione un motivo', id: ''}].concat(response.data);
              this.cancelWork.subject_id = this.cancelList[0]['id'];
          }
          // detengo loading
          this.stopRefreshing();
          // abro modal.
          $('#abort-work-modal').modal('show');
      },
      error => this.stopRefreshing(),
      () => this.stopRefreshing()
    );


  }
  public anularTrabajo(){
      //console.log(this.request_id);
      // buscar id del trabajo.
      this.cancelWork.request_id = this.request_id;
      // cerrar modal
      $('#abort-work-modal').modal('hide');
      // mostrar loading
      this.isRequesting = true;
      // anular trabajo ajax
      this.api.post('/api/requests/cancel_work',this.cancelWork)
        .subscribe((response)=>{
            if(response && response.success){
                // Mostrar mensaje de exito
                this.myToast.addToast(response.data.class, { title:response.data.title, msg:response.data.message, timeout: 6000});
                // Esconder trabajo rechazado. Sacar trabajo en Curso
                this.current_request = null;
                // Limpiar datos modal de anulación
                this.cancelWork.subject_id = '';
                this.cancelWork.message = '';
                this.cancelWork.request_id = null;
            }
            else{
                // Mostrar mensaje de error.
                this.myToast.addToast(response.data.class, { title:response.data.title, msg:response.data.message, timeout: 6000});
            }
        },
        error => this.stopRefreshing(),
        () => this.stopRefreshing()
      );
      // cerrar loading


  }

  /**
  *
  *     Comenzar Trabajo
  *
  */

  public comenzarTrabajoModal(id:number){
      this.request_id = id;
  }

  public comenzarTrabajo(){
      let id = this.request_id;
      this.isRequesting = true;
      this.api.post('/api/requests/start_work',{id: id})
        .subscribe((response)=>{
             if(response && response.success){
                 this.myToast.addToast(response.data.class, { title:response.data.title, msg:response.data.message, timeout: 6000});
                 // recargo trabajos.
                 this.getWorks(true);
             }
             else{
                 // Error server
                 this.myToast.addToast('error', { title:'Error al iniciar el Trabajo', msg:'Ocurrió un problema al iniciar el trabajo. Por favor contacte al soporte de Fullmec', timeout: 6000});
                 this.stopRefreshing();
            }
        },
        error => this.stopRefreshing(),
        () =>{}
    );


  }

  /**
  *
  *     Finalizar Trabajo
  *
  */

  // mostrar modal
  public finalizarTrabajoModal(id:number){
      this.request_id = id;
      $('#finish-work-modal').modal('show');
  }

  // redirigir a página  finalzar trabajo
  public finalizarTrabajo(){
    this.router.navigateByUrl('/pages/trabajo/finalizar/paso1/'+this.request_id);
  }

  /*
  *
  *     Solicitar llamada, se enviará un correo notificando
  *
  */
  public solicitarLlmadaModal(request_id: number){
    this.request_id = request_id;
  }
  public solicitarLlamada(){
    let request_id = this.request_id;
    this.api.post('/api/requests/callmenow',{id: request_id}).subscribe((data)=>{
       if(data && data.success){
          this.myToast.addToast(data.response.class, { title:data.response.title, msg:data.response.message, timeout: 6000});
       }
       else{
         this.myToast.addToast('error', { title:'Error al enviar el mensaje', msg:'Intente más tarde', timeout: 6000});
       }
    });
  }



  goPageEdit(request_id){
    this.router.navigate(['/pages/trabajo/edit/'+request_id]);
  }




}
