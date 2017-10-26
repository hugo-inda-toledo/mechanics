import { Component, OnInit, AfterViewInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';

// para la API
import { ApiRestService } from '../../../services/api.rest.service';
import { StatusRequest } from '../../../services/status.requests';

// para el formulario
import { Validators, FormGroup, FormArray, FormBuilder } from '@angular/forms';
import { Question } from '../../../interfaces/request_question.interface';

// Mensajes Toast
import { MyToastService } from '../../../services/toast.service';

// util
import { ShowData } from './utils/show-data.class';

// star rating
import { AcStars, AcStar } from '../../../custom-components/star-rating/index'

@Component({
  templateUrl: 'informe-servicio.html',
  styleUrls: ['informes.scss']
})

export class FinalizarTrabajoPaso2Component implements OnInit, AfterViewInit {

    public ID: number;
    public myForm: FormGroup;
    public questions: Object = {};
    public rate: number;

    public getStatus = StatusRequest;
    public isRequesting: boolean;
    public messageRequesting: string = 'Espere un momento por favor...';

    public service = new ShowData();

    constructor(
        private api: ApiRestService,
        private _fb: FormBuilder,
        private activatedRoute: ActivatedRoute,
        private router: Router,
        private myToast: MyToastService
    ) {
    }

    // stop spinner
    private stopRefreshing() {
        this.isRequesting = false;
    }

    // revisar si objeto es empty
    public isEmptyObject(obj) {
        return (Object.keys(obj).length === 0);
    }

    // crear control para formulario
    private addControls(q){
      const radios = <FormArray>this.myForm.controls['radios'];
      let radio = this._fb.group({
          question_id : [q['id']],
          comment: [''],
          alternative: ['', Validators.required],
          has_comment: [false],
      });
      radios.push(radio);
    }

    // cargar preguntas informe servicio
    public loadServiceData(){
        this.service.loading.message = 'Cargando...';
        this.api.post('/api/report_questions/service',{id: this.ID})
        .subscribe((response) =>{
           // si todo llego correcto, entonces.
           if(response.success && response.data.questions){
                // creo validacion para los campos del formulario
                // y agrego variable hideComment a cada pregunta (question)
                let index = 0;
                for(let question of response.data.questions){
                    this.addControls(question);
                    question['hideComment'] = true;
                    index++;
                }
                // guardo preguntas y muestro en vista.
                this.questions = response.data.questions;
                this.service.hidden = false;
           }
           else{
               this.service.loading.message = response.message;
           }
       });
    }

  ngOnInit() {
     // creo base del formulario
     this.myForm = this._fb.group({
         radios: this._fb.array([]),
         rate: ["",Validators.required],
         obs: [""]
     });

     // registar ID del trabajo
    this.activatedRoute.params.subscribe((params: Params) => {
        this.ID = params['id'] || null;
    });

    // cargar preguntas servicio
    this.loadServiceData();
  }

  ngAfterViewInit(){
      // revisar si hay mensajes pendientes.
      this.myToast.hasMessages();
  }


  // revisar si habilito o no el textarea para comentario
  // en caso de mostrar textarea, agregar validación de campo requerido.
   public checkComment(has_comment: boolean,index: number){
       if(has_comment){
           this.myForm.controls['radios']['controls'][index].controls['has_comment'].setValue(true);
           this.questions[index].hideComment = false;
           this.myForm.controls['radios']['controls'][index].controls['comment'].setValidators([Validators.required, Validators.minLength(3)]);
           this.myForm.controls['radios']['controls'][index].controls['comment'].updateValueAndValidity();
       }
       else{
           this.myForm.controls['radios']['controls'][index].controls['has_comment'].setValue(false);
           this.myForm.controls['radios']['controls'][index].controls['comment'].setValidators(null);
           this.myForm.controls['radios']['controls'][index].controls['comment'].updateValueAndValidity();
           this.questions[index].hideComment = true;
       }
   }

   // Guardar Rate en input.
   public saveRate(rate: number){
       this.rate = rate;
       this.myForm.controls['rate'].setValue(rate);
   }

  // Guardar formulario con respuestas
  public saveForm(form){

      // habilitar loading.
      this.isRequesting = true;

      // deshabilitar btn submit para prevenir duplicidad de post
      this.service.btn_disabled = true;

      // registrar datos
      this.api.post('/api/report_questions/save_report_service',{answers: form, id: this.ID})
        .subscribe((response) =>{
          // mostrar mensaje y enconder formulario.
          if(response.success){
            this.service.hidden = true;
            this.myToast.addToast(response.data.class, { title: response.data.title, msg: response.message, timeout: 4000, later: true});
            // redirigir a trabajos
            this.router.navigateByUrl('/pages/trabajo');            
          }
          // en caso de error
          else{
              if(response && response.message){
                  this.myToast.addToast('error', { title: 'Error detectado', msg: response.message, timeout: 5000});
              }
              else{
                  this.myToast.addToast('error', { title: 'Error', msg: 'Error desconocido. Por favor contacte a Fullmec', timeout: 5000});
              }
              this.service.btn_disabled = false;
          }
        },
        // Error & Finally (detener loading)
        error => {
            this.stopRefreshing()
            this.myToast.addToast('error', { title: 'Ocurrió un error', msg: 'Por favor intenta más tarde.', timeout: 5000});
        },
        () => {
            // Habilitar btn submit
            this.service.btn_disabled = false;
            this.stopRefreshing();
        }
    );
  }

}
