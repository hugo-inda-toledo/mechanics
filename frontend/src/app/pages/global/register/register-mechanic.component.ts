import { Component, ViewEncapsulation , OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormGroup, FormControl, AbstractControl, FormBuilder, Validators} from '@angular/forms';

import { UsersService } from '../../../modelCtlr/users.service';
import { CitiesService } from '../../../modelCtlr/cities.service';
import { CommunesService } from '../../../modelCtlr/communes.service';

import { Commune } from '../../../models/commune.model';
import { City } from '../../../models/city.model';

import { emailValidator } from '../../../services/validators.service';
import { matchingPasswords } from '../../../services/validators.service';

@Component({
    selector: 'register-mechanic',
    encapsulation: ViewEncapsulation.None,
    styleUrls: ['./register.scss'],
    templateUrl: './register-mechanic.html'
})

export class RegisterMechanicComponent  implements OnInit {
    public router: Router;
    public form:FormGroup;

    public cities: Array<City>;
    public communes: Array<Commune>;

    //input de formulario
    public firstName:AbstractControl;
    public lastName:AbstractControl;
    public email:AbstractControl;
    public phone1:AbstractControl;
    public city_id:AbstractControl;
    public commune_id:AbstractControl;
    public address_name: AbstractControl;
    public address_number: AbstractControl;
    public address_complement: AbstractControl;
    public password:AbstractControl;
    public confirmPassword:AbstractControl;

    //output
    public error: string ='';
    public loading: boolean = false;

    constructor(
      router:Router,
      fb:FormBuilder,
      public usersService: UsersService,
      public communesService: CommunesService,
      public citiesService: CitiesService
    ){
        this.router = router;

        //Formulario
        this.form = fb.group({
            firstName: ['', Validators.compose([Validators.required, Validators.minLength(3)])],
            lastName: ['', Validators.compose([Validators.required, Validators.minLength(3)]) ],
            email: ['', Validators.compose([Validators.required, emailValidator])],
            phone1:['', Validators.required],
            /*city_id:['', Validators.required],
            commune_id:['', Validators.required],
            address_name: ['', Validators.required],
            address_number: ['', Validators.required],
            address_complement: [''],*/
            password: ['', Validators.required],
            confirmPassword: ['', Validators.required]
        },{validator: matchingPasswords('password', 'confirmPassword')});

        this.firstName = this.form.controls['firstName'];
        this.lastName = this.form.controls['lastName'];
        this.email = this.form.controls['email'];
        this.phone1 = this.form.controls['phone1'];
        /*this.city_id = this.form.controls['city_id'];
        this.commune_id = this.form.controls['commune_id'];
        this.address_name = this.form.controls['address_name'];
        this.address_number = this.form.controls['address_number'];
        this.address_complement = this.form.controls['address_complement'];*/
        this.password = this.form.controls['password'];
        this.confirmPassword = this.form.controls['confirmPassword'];

        //Servicios
        this.usersService= usersService;
        this.citiesService= citiesService;
        this.communesService= communesService;
    }


    ngOnInit() {
        this.citiesService.get()
            .subscribe(response => {
                this.cities = response.data;
            });
    }

    onChangeCity(cityChoosed: string){
      this.communesService.getByCity(cityChoosed.split(':')[1].replace(/ /g,''))
          .subscribe(response => {
              this.communes = response.data;
          });
    }

    redirectLogin(){
      this.router.navigate(['/login']);
    }

     public onSubmit(values:any):void {
        if (this.form.valid) {
            this.loading=true;
            this.error='';
            let user={
              role_id: '6',
              name: values.firstName,
              last_name: values.lastName,
              email : values.email,
              phone1: ''+values.phone1,
              /*address_name : 'Tucapel Jimenez',
              address_number : '136',
              address_complement : '2815',
              commune_id: ''+values.commune_id,
              city_id : ''+ values.city_id,*/
              password: values.password,
              confirm_password: values.confirmPassword
            };

            this.usersService.register(user).subscribe(
              result => {
                  console.log(result);
                  if (result.success === true) {
                      document.getElementById("openModalButton").click();
                  } else {
                      this.error = 'Ha habido algún error';
                      this.loading = false;
                  }
              },
              err => {
                console.log(err);
                this.error = 'Ha habido algún error';
                this.loading = false;
              });
        }
    }

}
