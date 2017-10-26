import { Component, ViewEncapsulation , OnInit, ViewChild, NgZone  } from '@angular/core';
import { Router } from '@angular/router';

import { FileUploader } from 'ng2-file-upload';
import { ServerConfig } from '../../app.server.config';
import { MyToastService } from '../../services/toast.service';

import { AuthenticationService } from '../../auth/authentication.service';
import { UsersService } from '../../modelCtlr/users.service';
import { CitiesService } from '../../modelCtlr/cities.service';
import { CommunesService } from '../../modelCtlr/communes.service';

import { Commune } from '../../models/commune.model';
import { City } from '../../models/city.model';
import { User, UserRoles } from '../../models/user.model';

const maxFileSize= 1024*1024*1;
const typeFileImageAcepted= ['image/png', 'image/jpg', 'image/jpeg'];

@Component({
  selector: 'mi-perfil',
  styleUrls: ['./mi-perfil.scss'],
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'mi-perfil.html'
})
export class MiPerfilComponent implements OnInit {
  //@ViewChild('fileInput') fileInput;
  public uploader:FileUploader;
  public urlServer: string;
  public errors: any;
  public showErrors: boolean = false;

  public user : User;
  public userRoles: any;
  public imageProfile: any;

  public cities: Array<City>;
  public communes: Array<Commune>;

  //output
  public error: string ='';
  public loading: boolean = false;
    constructor(
      private router:Router,
      public usersService: UsersService,
      public authService: AuthenticationService,
      private ngZone: NgZone,
      private myToastService: MyToastService,
      private citiesService: CitiesService,
      private communesService: CommunesService
    ){
        //Servicios
        this.usersService= usersService;
        this.authService= authService;

        //Instancio constantes
        this.userRoles= UserRoles;

        this.urlServer= ServerConfig.url;
        this.uploader = new FileUploader({
          url: this.urlServer + '/api/users/photo/',
          method: 'POST',
          authToken: 'Bearer '+this.authService.token,
          allowedMimeType: typeFileImageAcepted,
          maxFileSize:  maxFileSize //1mb
        });

    }

    ngOnInit() {
      //Cargo usuario con el resultado del servicio
      this.usersService.get().subscribe(response => {
        this.user= response.data;
      });

      this.loadOptionsUploaderFile();
      this.loadCities();
    }


    //Cargo ciudades
    loadCities(){
      this.citiesService.get().subscribe(response => {
        this.cities = response.data;
      });
    }

    loadOptionsUploaderFile(){
      const self = this;

      //Despues de agregar una imagen, reseteo mensajes de error
      this.uploader.onAfterAddingAll= (item) => {
        self.showErrors= false;
        self.error= '';
      }

      this.uploader.onBeforeUploadItem = (item) => {
        item.withCredentials = false;
      }

      //Callback success de cuando se sube una imagen
      this.uploader.onSuccessItem = (item:any, response:any, status:number, headers:any) => {
        console.log("onSuccessItem " + status, item);
        let r = JSON.parse(response);
        if(r && r.data && r.data.dir_file){
          this.user.photo_url= r.data.dir_file;
          this.myToastService.addToast('success', { title:'Éxito', msg:'Se ha cambiado la foto de perfil exitosamente.' });
        }
      }

      //Callback error de cuando se sube una imagen
      this.uploader.onErrorItem = this.ngZone.run(() => function (item, response, status, headers) {
          let error = JSON.parse(response);
          self.errors = error.errors;
          self.showErrors = true;
          console.log(self.errors.length);
      });

      //Validacion de tipo de archivo y tamaño
      this.uploader.onWhenAddingFileFailed = (fileItem) => {
        console.log("fail load file", fileItem);

        if(fileItem.size > maxFileSize){
          console.log("fail file size:", fileItem.size);
          self.showErrors= true;
          self.error='Excede el tamaño maximo permitido.';
        }

        if(typeFileImageAcepted.indexOf(fileItem.type)=== -1){
          console.log("fail file type:", fileItem.type);
          self.showErrors= true;
          self.error='No es del tipo de archivo permitido.';
        }
      }
    }

    logout(){
      this.authService.logout();
      this.router.navigateByUrl('/login');
    }

    goTo(route: string){
      this.router.navigateByUrl('pages/'+ route);
    }

    handleUserUpdated(obj2update){
      this.user = (<any>Object).assign({}, this.user, obj2update );
    }

    handlerUpdateImage(imageUpdated){
      this.imageProfile= imageUpdated
    }

    saveImage(){
      console.log(this.imageProfile);
    }

}
