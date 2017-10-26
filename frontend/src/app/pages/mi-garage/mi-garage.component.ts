import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { CarsService } from '../../modelCtlr/cars.service';
import { Car } from '../../models/car.model';
import { Router } from '@angular/router';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';

@Component({
  selector: 'mi-garage',
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'mi-garage.html'
})

export class MiGarageComponent implements OnInit {
    cars : Array<any>;
    public loading = false;
    public form:FormGroup;
    public score:AbstractControl;
    public observations:AbstractControl;

    public request_idd:number;
    public mechanic_idd:number;

    public modal_title_success:string;
    public modal_body_success:string;




    constructor(private carsService: CarsService, public router : Router, fb:FormBuilder,) {
      this.router = router;
      this.form = fb.group({
            'score':        ['', Validators.compose([Validators.required])],
            'observations': ['', Validators.compose([Validators.nullValidator])]
        });

        this.score        = this.form.controls['score'];
        this.observations = this.form.controls['observations'];
    }

    ngOnInit() {
      // get cars
      this.getCars();
    }

    getCars(){
      // get cars
      this.carsService.getCars()
        .subscribe(response => {
          this.cars = response.data;
        });
    }
    addCar(){
      this.router.navigateByUrl('/pages/mi-garage/add-car');
    }


    ShowModalDeleteCar(id:number, patent:string){
      document.getElementById("modal-patent").innerHTML = patent;
      document.getElementById("btn_accept").setAttribute("onClick", "document.getElementById('a_delete_car_"+id+"').click();");
      document.getElementById("openModalButton").click();
    }

    deleteCar(id:number){
      this.loading = true;
      this.carsService.deleteCar(id)
        .subscribe(result => {
            console.log(result);
            if (result.success === true) {
              document.getElementById("modal_success").click();
              this.getCars();
            } else {
              this.loading = false;
              document.getElementById("modal_error").click();
            }
          });
    }

    ShowModalQualifications(idmechanic:number, idrequest:number){
      this.request_idd = idrequest;
      this.mechanic_idd = idmechanic;
      document.getElementById("openModalQualifications").click();
    }

    public onSubmitQualifications(values:any):void {
      if (this.form.valid) {
          jQuery('#qualifications-mechanic-modal').modal('hide');
          this.carsService.QualificationsMechanic(this.request_idd,this.mechanic_idd,values.score,values.observations).subscribe(result => {
          console.log(result);
          if (result.success === true) {
            document.getElementById("modal-success-label").innerHTML = 'Calificación Exitosa!';
            document.getElementById("modal_success").click();
            this.getCars();
          } else {
            this.loading = false;
            document.getElementById("modal-error-label").innerHTML = 'Disculpe, calificacion no enviada';
            document.getElementById("modal_error").click();
          }
        });
      }
    }

}
