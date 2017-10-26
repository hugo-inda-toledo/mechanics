import { NgModule } from '@angular/core';
import { BrowserModule, Title } from '@angular/platform-browser';
import { HttpModule } from '@angular/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { PdfViewerComponent } from 'ng2-pdf-viewer';

/*import { ChartsModule } from 'ng2-charts/ng2-charts';
import { FroalaEditorModule } from "ng2-froala-editor/ng2-froala-editor";
import { CKEditorModule } from 'ng2-ckeditor';
import { DataTableModule } from "angular2-datatable";*/
import { ToastyModule } from 'ng2-toasty';

import { routing } from './app.routing';
import { AppConfig } from './app.config';
import { LOCALE_ID } from '@angular/core';


//General
import { AppComponent } from './app.component';
import { PagesComponent } from './pages/pages.component';
//import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { FileSelectDirective, FileDropDirective } from 'ng2-file-upload';
import { MyToastService } from './services/toast.service';


/*Auth*/
import { AuthGuard } from './auth/auth.guard';
import { AuthenticationService } from './auth/authentication.service';

//ModelCtlr
import { CarsService } from './modelCtlr/cars.service';
import { UsersService } from './modelCtlr/users.service';
import { CitiesService } from './modelCtlr/cities.service';
import { CommunesService } from './modelCtlr/communes.service';
import { RequestsService } from './modelCtlr/requests.service';
import { SchedulesService } from './modelCtlr/schedules.service';
import { UsersCommunesService } from './modelCtlr/users_communes.service';
import { CarBrandsService } from './modelCtlr/car_brands.service';
import { CarModelsService } from './modelCtlr/car_models.service';
import { RequestsMechanicModsService } from './modelCtlr/requests_mechanic_mods.service';

//Pages
import { BlankComponent } from './pages/global/blank/blank.component';
import { LoginComponent } from './pages/global/login/login.component';
import { RegisterClientComponent } from './pages/global/register/register-client.component';
import { RegisterMechanicComponent } from './pages/global/register/register-mechanic.component';
import { PageNotFoundComponent } from './pages/global/error/pagenotfound.component';
import { SearchComponent } from './pages/global/search/search.component';
import { RecoverPasswordComponent } from './pages/global/recover-password/recover-password.component';
import { ConfirmRecoverPasswordComponent } from './pages/global/recover-password/confirm-recover-password.component';
import { ConfirmRegisterComponent } from './pages/global/confirm-register/confirm-register.component';

import { AjustesComponent } from './pages/ajustes/ajustes.component';
import { ContactoComponent } from './pages/contacto/contacto.component';
import { MiGarageComponent } from './pages/mi-garage/mi-garage.component';
import { MiPerfilComponent } from './pages/mi-perfil/mi-perfil.component';
import { DatosPersonalesComponent } from './pages/mi-perfil/datos-personales.component';
import { DatosContraseniaComponent } from './pages/mi-perfil/datos-contrasenia.component';
import { DatosHabilidadesComponent } from './pages/mi-perfil/datos-habilidades.component';
import { DatosHerramientasComponent } from './pages/mi-perfil/datos-herramientas.component';
import { DatosAreaTrabajoComponent } from './pages/mi-perfil/datos-area-trabajo.component';

import { NotificacionesComponent } from './pages/notificaciones/notificaciones.component';
import { PreguntasFrecuentesComponent } from './pages/preguntas-frecuentes/preguntas-frecuentes.component';

import { SolicitarServiciosComponent } from './pages/servicios/solicitar-servicios.component';
import { AddRequestsComponent } from './pages/servicios/add-requests.component';
import { Step2AddRequestsComponent } from './pages/servicios/step-2-add-requests.component';
import { Step3AddRequestsComponent } from './pages/servicios/step-3-add-requests.component';
import { WebpayFinishComponent } from './pages/servicios/webpay-finish.component';
import { WebpayRejectionComponent } from './pages/servicios/webpay-rejection.component';
import { HelpMeRequestsComponent } from './pages/servicios/help-me-requests.component';
import { ViewRequestComponent } from './pages/servicios/view-request.component';
import { ApproveChangesRequestComponent } from './pages/servicios/approve-changes-request.component';

import { HorariosComponent } from './pages/horarios/horarios.component';

// trabajos mecánico
import { TrabajoComponent } from './pages/trabajo/trabajo.component';
import { MisTrabajosComponent } from './pages/trabajo/mis-trabajos.component';
import { FinalizarTrabajoPaso1Component } from './pages/trabajo/finalizar/informe-salud.component';
import { FinalizarTrabajoPaso2Component } from './pages/trabajo/finalizar/informe-servicio.component';
import { MiTrabajoComponent } from './pages/trabajo/mi-trabajo.component';
import { EditRequestMechanicComponent } from './pages/trabajo/edit-request-mechanic.component';


import { AddCarComponent } from './pages/mi-garage/add-car.component';
import { EditCarComponent } from './pages/mi-garage/edit-car.component';
import { ViewCarComponent } from './pages/mi-garage/view-car.component';

//pages components collection
/*import { DatamapComponent } from './pages/dashboard/datamap/datamap.component';
import { DynamicChartComponent } from './pages/dashboard/dynamic-chart/dynamic-chart.component';
import { TodoComponent } from './pages/dashboard/todo/todo.component';
import { ChatComponent } from './pages/dashboard/chat/chat.component';
import { FeedComponent } from './pages/dashboard/feed/feed.component';*/


//theme components
import { Navbar } from './theme/components/navbar/navbar.component';
import { Messages } from './theme/components/messages/messages.component';
import { Sidebar } from './theme/components/sidebar/sidebar.component';
import { Breadcrumb } from './theme/components/breadcrumb/breadcrumb.component';
import { BackTop } from './theme/components/back-top/back-top.component';


//directives
import {SlimScroll} from './theme/directives/slim-scroll/slim-scroll.directive';
import {ProgressAnimate} from './theme/directives/progress-animate/progress-animate.directive';
import {Widget} from './theme/directives/widget/widget.directive';
import {LiveTile} from './theme/directives/live-tile/live-tile.directive';
/*import {Skycon} from './theme/directives/skycon/skycon.directive';
import {Counter} from './theme/directives/counter/counter.directive';
import {DropzoneUpload} from './theme/directives/dropzone/dropzone.directive';*/


//pipes
import {ProfilePicturePipe} from './theme/pipes/profilePicture/profilePicture.pipe';
import {AppPicturePipe} from './theme/pipes/appPicture/appPicture.pipe';
import {SearchPipe} from './theme/pipes/search/search.pipe';
import {MailSearchPipe} from './theme/pipes/search/mail-search.pipe';


// servicio para buscar datos con API (get,post)
import { ApiRestService } from './services/api.rest.service';

// usar para espera de loading
import { SpinnerComponent } from './custom-components/spin/spinner.component';

// star rating
import { AcStar, AcStars } from './custom-components/star-rating/index'


@NgModule({
  imports: [
    BrowserModule,
    HttpModule,
    FormsModule,
    ReactiveFormsModule,
    routing,
    /*ChartsModule,
    DataTableModule,*/
    ToastyModule.forRoot()
  ],
  declarations: [
    AppComponent,
    PdfViewerComponent,
    PagesComponent,
    BlankComponent,
    LoginComponent,
    RegisterClientComponent,
    RegisterMechanicComponent,
    PageNotFoundComponent,
    SearchComponent,
    RecoverPasswordComponent,
    ConfirmRecoverPasswordComponent,
    ConfirmRegisterComponent,
    HorariosComponent,
    Navbar,
    Messages,
    Sidebar,
    /*DashboardComponent,
    DatamapComponent,
    DynamicChartComponent,
    TodoComponent,
    ChatComponent,
    FeedComponent,*/
    AjustesComponent,
    ContactoComponent,
    MiGarageComponent,
    MiPerfilComponent,
    DatosPersonalesComponent,
    DatosContraseniaComponent,
    DatosHabilidadesComponent,
    DatosHerramientasComponent,
    DatosAreaTrabajoComponent,
    NotificacionesComponent,
    PreguntasFrecuentesComponent,
    SolicitarServiciosComponent,
    AddRequestsComponent,
    Step2AddRequestsComponent,
    Step3AddRequestsComponent,
    WebpayFinishComponent,
    WebpayRejectionComponent,
    HelpMeRequestsComponent,
    ViewRequestComponent,
    ApproveChangesRequestComponent,
    AddCarComponent,
    EditCarComponent,
    ViewCarComponent,
    HorariosComponent,
    // Trabajos para el mecánico
    TrabajoComponent,
    MisTrabajosComponent,
    FinalizarTrabajoPaso1Component,
    FinalizarTrabajoPaso2Component,
    MiTrabajoComponent,
    EditRequestMechanicComponent,


    //WizardComponent,
    //BasicTablesComponent,
    //DynamicTablesComponent,
    Breadcrumb,
    BackTop,
    SlimScroll,
    ProgressAnimate,
    Widget,
    LiveTile,
    /*Skycon,
    Counter,
    DropzoneUpload,*/
    ProfilePicturePipe,
    AppPicturePipe,
    SearchPipe,
    MailSearchPipe,
    FileSelectDirective,


    // spinner loading
    SpinnerComponent,
    // star rating
    AcStar,
    AcStars,
    // Otros

  ],
  providers: [
    { provide: LOCALE_ID, useValue: "es-CL" },
    Title,
    AppConfig,
    MyToastService,
    //Services
    AuthGuard,
    AuthenticationService,
    CarsService,
    UsersService,
    CommunesService,
    CitiesService,
    RequestsService,
    UsersCommunesService,
    SchedulesService,
    CarBrandsService,
    CarModelsService,
    RequestsMechanicModsService,
    // Api service
    ApiRestService
  ],
  bootstrap: [ AppComponent ]


})
export class AppModule {
}
