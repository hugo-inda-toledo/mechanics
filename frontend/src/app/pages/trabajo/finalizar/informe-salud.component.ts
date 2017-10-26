import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';

// para la API
import { ApiRestService } from '../../../services/api.rest.service';
import { StatusRequest } from '../../../services/status.requests';

// para el formulario
import { Validators, FormGroup, FormArray, FormBuilder } from '@angular/forms';
import { Question } from '../../../interfaces/request_question.interface';

// Mensajes Toast
import { MyToastService } from '../../../services/toast.service';
// u
import { ShowData } from './utils/show-data.class';

@Component({
  selector: 'preguntas-reporte-salud',
  templateUrl: 'informe-salud.html',
  styleUrls: ['informes.scss']
})

export class FinalizarTrabajoPaso1Component implements OnInit {

    public ID: number;
    public myForm: FormGroup;
    public hidden: boolean = false;
    public questions: Object = {};

    public getStatus = StatusRequest;
    public isRequesting: boolean;
    public messageRequesting: string = 'Espere un momento por favor...';

    public service = new ShowData();

    constructor(
        private api: ApiRestService,
        private router: Router,
        private _fb: FormBuilder,
        private activatedRoute: ActivatedRoute,
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

    private addControls(q){
        const radios = <FormArray>this.myForm.controls['radios'];
        let radio = this._fb.group({
            question_id : [q['id']],
            alternative: ['', Validators.required],
            score: [0]
        });
        radios.push(radio);
    }

    ngOnInit() {

         // creo base del formulario
         this.myForm = this._fb.group({
             radios: this._fb.array([]),
             total_score: []
         });

         // registar ID del trabajo
        this.activatedRoute.params.subscribe((params: Params) => {
            this.ID = params['id'] || null;
        });

        // Buscar preguntas para informe de servicio en la API
        this.api.post('/api/report_questions/health',{id: this.ID})
            .subscribe((response) =>{
                // si todo llego correcto, entonces.
                if(response.success && response.data.questions){
                     // generó formulario con validación
                     for(let question of response.data.questions){
                         this.addControls(question);
                     }
                     // guardo preguntas y muestro en vista.
                     this.questions = response.data.questions;
                     this.service.hidden = false;
                }
                else{
                    // Ya tiene reporte, saltar a paso 2.
                    if(response && response.data.hasReport){
                        console.log('ya tiene informe salud.');
                        this.goToStep2();
                    }
                    this.service.loading.message = response.message ? response.message : '';
                }
            }
        );
  }

  // Ir al Paseo 2: informe de servicio
  public goToStep2(){
      this.router.navigateByUrl('/pages/trabajo/finalizar/paso2/'+this.ID);
  }

  // Saltar el informe y continuar con el paso 2
  public skipReport(){
      this.goToStep2();
  }

 // setiar puntaje segun alternativa marcada.
  public checkScore(score: number, index: number){
      this.myForm.controls['radios']['controls'][index].controls['score'].setValue(score);
      // calcular total score.
      let total_score = this.myForm.controls['radios'].value.reduce((sum, val) => sum + val.score, 0);
      this.myForm.controls['total_score'].setValue(total_score);
  }

  // Guardar formulario con respuestas
  public saveForm(form){
      // habilitar loading.
      this.isRequesting = true;

      // deshabilitar btn.
      this.service.btn_disabled = true;

      // registrar datos
      this.api.post('/api/report_questions/save_report_health',{answers: form, id: this.ID})
        .subscribe((response) =>{
          // mostrar mensaje y enconder formulario.
          if(response && response.success){
            this.stopRefreshing();
            this.myToast.addToast(response.data.class, { title: response.data.title, msg: response.message, timeout: 4000, later: true});
            this.service.hidden = true;
            this.service.loading.message = 'Gracias por contestar el informe de Salud.';
            this.goToStep2();
          }
          // en caso de error, volver a habiltar btn.
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
        // Error & Finally
        error => {
            this.stopRefreshing();
            this.service.btn_disabled = false;
        },
        () => {
            this.stopRefreshing();
            this.service.btn_disabled = false;
        }
    );
  }

}
