import { Component, ViewEncapsulation, OnInit, OnDestroy } from '@angular/core';
import { CarsService } from '../../modelCtlr/cars.service';
import { CarBrandsService } from '../../modelCtlr/car_brands.service';
import { CarModelsService } from '../../modelCtlr/car_models.service';
import { Car } from '../../models/car.model';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import { Router } from '@angular/router';
import { Location } from '@angular/common';
import { ActivatedRoute } from '@angular/router';


@Component({
  selector: 'edit-car',
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'edit-car.html'
})

export class EditCarComponent implements OnInit, OnDestroy {
    public id: number;
    public car: any;

    public carbrands: Array<any>;
    public carmodels: Array<any>;

    private sub: any;
    public loading = false;
    public error = '';
    public router: Router;

    //Form
    public form:FormGroup;
    public car_brand_id:AbstractControl;
    public car_model_id:AbstractControl;
    public year:AbstractControl;
    public patent:AbstractControl;
    public mileage:AbstractControl;
    public observations:AbstractControl;

    constructor(
        private carsService: CarsService,
        private carBrandsService: CarBrandsService,
        private carModelsService: CarModelsService,
        router:Router,
        fb:FormBuilder,
        private _location: Location,
        private activateRoute: ActivatedRoute
      ) {
        this.router = router;
        this.form = fb.group({
            'car_brand_id': ['', Validators.compose([Validators.required])],
            'car_model_id': ['', Validators.compose([Validators.required])],
            'year':         ['', Validators.compose([Validators.required, Validators.minLength(4)])],
            'patent':       ['', Validators.compose([Validators.required, Validators.minLength(6)])],
            'mileage':      ['', Validators.compose([Validators.required, Validators.minLength(1)])],
            'observations': ['', Validators.compose([Validators.nullValidator])]
        });

        this.car_brand_id = this.form.controls['car_brand_id'];
        this.car_model_id = this.form.controls['car_model_id'];
        this.year         = this.form.controls['year'];
        this.patent       = this.form.controls['patent'];
        this.mileage      = this.form.controls['mileage'];
        this.observations = this.form.controls['observations'];
    }

    public onSubmit(values:any):void {
        this.editCar(this.id, values.car_brand_id, values.car_model_id, values.year, values.patent, values.mileage, values.observations);
    }

    ngOnInit() {
      // get car
      let _self= this;
      this.sub = this.activateRoute.params.subscribe(params => {
         _self.id = +params['id']; // (+) converts string 'id' to a number

         _self.carBrandsService.get()
          .subscribe(response => {
            if(response && response.data){
              this.carbrands = response.data;
            }
          });

          _self.getCar(_self.id);
      });
    }

    getCar(idCar){
      this.carsService.getCar(idCar)
         .subscribe(response => {
             this.car = response.data;
             this.carModelsService.getByBrands(this.car.car_brand_id)
                .subscribe(response => {
                    this.carmodels = response.data;
             });
             let nameInputs= ['car_brand_id', 'car_model_id', 'year', 'patent', 'mileage', 'observations'];
             for(let input of nameInputs){
               this.form.get(input).setValue(this.car[input]);
             }
         });
    }

    editCar(idcar:number, car_brand_id:number, car_model_id:number, year:number, patent:string, mileage:number, observations:string){
      this.loading = true;
      this.carsService.editCar(idcar, car_brand_id, car_model_id, year, patent, mileage, observations)
          .subscribe(result => {
              console.log(result);
              if (result.success === true) {
                  // update successful
                  this.router.navigate(['/pages/mi-garage']);
              } else {
                  // update failed
                  this.error = 'Disculpe, no se pudo editar el registro';
                  this.loading = false;
              }
          });
    }

    onChangeCarBrands(carbrandChoosed: string){
      // console.log(carbrandChoosed);
      // console.log(carbrandChoosed.split(':')[1].replace(/ /g,''));
      // this.communesService.getByCity(cityChoosed.split(':')[1].replace(/ /g,''))
      this.carModelsService.getByBrands(carbrandChoosed.split(':')[1].replace(/ /g,''))
          .subscribe(response => {
              this.carmodels = response.data;
       });
    }

    backClicked() {
        this._location.back();
    }

    ngOnDestroy() {
      this.sub.unsubscribe();
    }




}
