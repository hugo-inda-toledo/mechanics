import { Component, ViewEncapsulation, OnInit } from '@angular/core';
import { CarsService } from '../../modelCtlr/cars.service';
import { CarBrandsService } from '../../modelCtlr/car_brands.service';
import { CarModelsService } from '../../modelCtlr/car_models.service';
import { Car } from '../../models/car.model';
import { CarBrand } from '../../models/car_brand.model';
import { CarModel } from '../../models/car_model.model';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import { Router } from '@angular/router';
import { Location } from '@angular/common';


@Component({
  selector: 'add-car',
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'add-car.html'
})

export class AddCarComponent implements OnInit {
    loading = false;
    error = '';
    cars : Array<any>;

    public carbrands: Array<any>;
    public carmodels: Array<any>;

    public router: Router;
    public form:FormGroup;
    public car_brand_id:AbstractControl;
    public car_model_id:AbstractControl;
    public year:AbstractControl;
    public patent:AbstractControl;
    public mileage:AbstractControl;
    public observations:AbstractControl;

    public modal_title_success:string;
    public modal_body_success:string;

    constructor(
      private carsService: CarsService,
      private carBrandsService: CarBrandsService,
      private carModelsService: CarModelsService,
      router:Router,
      fb:FormBuilder,
      private _location: Location) {
      this.router = router;
        this.form = fb.group({
            'car_brand_id':        ['', Validators.compose([Validators.required])],
            'car_model_id':        ['', Validators.compose([Validators.required])],
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
        if (this.form.valid) {
            console.log(values);
            this.addCar(values.car_brand_id, values.car_model_id, values.year, values.patent, values.mileage, values.observations);
        }
    }

    ngOnInit() {
      console.log('INNICIO AUTO');
      this.getCarBrands();
    }

    getCarBrands(){
      // get car brands
      this.carBrandsService.get()
        .subscribe(response => {
          if(response && response.data){
            this.carbrands = response.data;
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

    addCar(car_brand_id:number, car_model_id:number, year:number, patent:string, mileage:number, observations:string){
      this.loading = true;
      this.carsService.addCar(car_brand_id, car_model_id, year, patent, mileage, observations)
          .subscribe(result => {
              console.log(result);
              if (result.success === true) {
                  // register successful
                  this.modal_title_success = "Registro exitoso";
                  this.modal_body_success = "Tu auto ha sido añadido exitosamente a tu garaje";
                  document.getElementById("modal_success_general").click();
              } else {
                  // register failed
                  this.error = 'Faild created to auto';
                  this.loading = false;
              }
          });
    }

    backClicked() {
        this._location.back();
    }

    goMiGaraje(){
      this.router.navigate(['/pages/mi-garage']);
    }





}
