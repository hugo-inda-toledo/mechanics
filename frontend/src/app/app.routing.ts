import { ModuleWithProviders }  from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

//General
import { PagesComponent } from './pages/pages.component';
//import { DashboardComponent } from './pages/dashboard/dashboard.component';

import { AddCarComponent } from './pages/mi-garage/add-car.component';
import { EditCarComponent } from './pages/mi-garage/edit-car.component';
import { ViewCarComponent } from './pages/mi-garage/view-car.component';

//import { CalendarComponent } from './pages/calendar/calendar.component';
import { AuthGuard } from './auth/auth.guard';

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
import { NotificacionesComponent } from './pages/notificaciones/notificaciones.component';
import { PreguntasFrecuentesComponent } from './pages/preguntas-frecuentes/preguntas-frecuentes.component';
import { SolicitarServiciosComponent } from './pages/servicios/solicitar-servicios.component';
import { HorariosComponent } from './pages/horarios/horarios.component';

// trabajos mecánico
import { TrabajoComponent } from './pages/trabajo/trabajo.component';
import { MisTrabajosComponent } from './pages/trabajo/mis-trabajos.component';
import { MiTrabajoComponent } from './pages/trabajo/mi-trabajo.component';
import { FinalizarTrabajoPaso1Component } from './pages/trabajo/finalizar/informe-salud.component';
import { FinalizarTrabajoPaso2Component } from './pages/trabajo/finalizar/informe-servicio.component';
import { EditRequestMechanicComponent } from './pages/trabajo/edit-request-mechanic.component';

// solicitudes?
import { AddRequestsComponent } from './pages/servicios/add-requests.component';
import { Step2AddRequestsComponent } from './pages/servicios/step-2-add-requests.component';
import { Step3AddRequestsComponent } from './pages/servicios/step-3-add-requests.component';
import { WebpayFinishComponent } from './pages/servicios/webpay-finish.component';
import { WebpayRejectionComponent } from './pages/servicios/webpay-rejection.component';
import { HelpMeRequestsComponent } from './pages/servicios/help-me-requests.component';
import { ViewRequestComponent } from './pages/servicios/view-request.component';
import { ApproveChangesRequestComponent } from './pages/servicios/approve-changes-request.component';

// servicio para buscar datos con API (get,post)
import { ApiRestService } from './services/api.rest.service';

const appRoutes: Routes = [
  {
    path: '',
    redirectTo: '/login',
    pathMatch: 'full'
  },
  {
    path: 'pages',
    component: PagesComponent,
    children : [
      /*{
        path: '',
        redirectTo: '/pages/dashboard',
        pathMatch: 'full'
      },*/
      {
        path: 'blank',
        component: BlankComponent,
        canActivate: [AuthGuard],
        data:{
          title: 'Blank Page'
        }
      },
      /*{
       path: 'dashboard',
       component: DashboardComponent,
       canActivate: [AuthGuard],
       data:{
         title: 'Dashboard'
       }
     },*/
      {
        path:'ajustes',
        component: AjustesComponent,
        canActivate: [AuthGuard],
        data: {
          title: 'Ajustes'
        }
      }
      ,
       {
         path:'contacto',
         component: ContactoComponent,
         canActivate: [AuthGuard],
         data: {
           title: 'Contacto'
         }
       }
       ,
        {
          path:'mi-garage',
          component: MiGarageComponent,
          canActivate: [AuthGuard],
          data: {
            title: 'Mi Garage',
            roles: ['5']
          }
        },{
              path:'mi-garage/add-car',
              component: AddCarComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Agregar Auto',
                roles: ['5']
              }
         },{
              path:'mi-garage/edit-car/:id',
              component: EditCarComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Editar Auto',
                roles: ['5']
              }
         },{
              path:'mi-garage/view-car/:id',
              component: ViewCarComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Historial de atenciones',
                roles: ['5']
              }
         }
        ,
         {
           path:'mi-perfil',
           component: MiPerfilComponent,
           canActivate: [AuthGuard],
           data: {
             title: 'Mi Perfil'
           }
         },
         // Muestra el trabajo de un mécanico
         {
           path:'trabajo',
           component: TrabajoComponent,
           canActivate: [AuthGuard],
           data: {
             title: 'Mi Trabajo',
             roles: ['6']
           }
         },
                // Datelle de un trabajo pendiente
                {
                  path:'trabajo/view/:id',
                  component: MiTrabajoComponent,
                  canActivate: [AuthGuard],
                  data: {
                    title: 'Detalle de trabajo',
                    roles: ['6']
                  }
                },

                // Editar de un trabajo pendiente
                {
                  path:'trabajo/edit/:id',
                  component: EditRequestMechanicComponent,
                  canActivate: [AuthGuard],
                  data: {
                    title: 'Detalle de trabajo',
                    roles: ['6']
                  }
                },
                // Finalizar Trabajo Paso1
               {
                 path:'trabajo/finalizar/paso1/:id',
                 component: FinalizarTrabajoPaso1Component,
                 canActivate: [AuthGuard],
                 data: {
                   title: 'Finalizar Trabajo Paso 1',
                   roles: ['6']
                 }
               },
               {
                 path:'trabajo/finalizar/paso2/:id',
                 component: FinalizarTrabajoPaso2Component,
                 canActivate: [AuthGuard],
                 data: {
                   title: 'Finalizar Trabajo Paso 2',
                   roles: ['6']
                 }
               },
         {
           path:'horarios',
           component: HorariosComponent,
           canActivate: [AuthGuard],
           data: {
             title: 'Horarios',
             roles: ['6']
           }
         }
         ,
          {
            path:'notificaciones',
            component: NotificacionesComponent,
            canActivate: [AuthGuard],
            data: {
              title: 'Notificaciones',
              roles: ['5', '6']
            }
          }
          ,
           {
             path:'preguntas-frecuentes',
             component: PreguntasFrecuentesComponent,
             canActivate: [AuthGuard],
             data: {
               title: 'Preguntas Frecuentes',
               roles: ['5', '6']
             }
           },
            {
              path:'solicitar-servicios',
              component: SolicitarServiciosComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Mis solicitudes',
                roles: ['5']
              }
            },
            {
              path:'solicitar-servicios/add-requests',
              component: AddRequestsComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Nueva solicitud',
                roles: ['5']
              }
            },
            {
              path:'solicitar-servicios/view/:id',
              component: ViewRequestComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Ver solicitud',
                roles: ['5']
              }
            },
            {
              path:'solicitar-servicios/add-requests-d/:id',
              component: AddRequestsComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Nueva solicitud',
                roles: ['5']
              }
            },
            {
              path:'solicitar-servicios/step-2-add-requests/:id',
              component: Step2AddRequestsComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Nueva solicitud',
                roles: ['5']
              }
            },
            {
              path:'solicitar-servicios/step-3-add-requests/:id/:id_type_payment',
              component: Step3AddRequestsComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Datos factura',
                roles: ['5']
              }
            },
            {
              path:'solicitar-servicios/webpay-finish/:id',
              component: WebpayFinishComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Resumen proceso de pago',
                roles: ['5']
              }
            },
            {
              path:'solicitar-servicios/webpay-rejection/:id',
              component: WebpayRejectionComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Resumen proceso de pago',
                roles: ['5']
              }
            },
            {
              path:'solicitar-servicios/help-me-requests',
              component: HelpMeRequestsComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Ayúdame a identificar mi problema',
                roles: ['5']
              }
            },
            {
              path:'solicitar-servicios/approve-changes/:id',
              component: ApproveChangesRequestComponent,
              canActivate: [AuthGuard],
              data: {
                title: 'Aprobar cambios',
                roles: ['5']
              }
            }
    ]
  },


  {
    path: 'login',
    component: LoginComponent
  },
  {
    path: 'register-client',
    component: RegisterClientComponent
  },
  {
      path: 'register-mechanic',
      component: RegisterMechanicComponent
  },
  {
      path: 'recover-password',
      component: RecoverPasswordComponent
  },
  {
      path: 'confirm-recover-password/:hashId',
      component: ConfirmRecoverPasswordComponent
  },
  {
      path: 'confirm-register/:hashId',
      component: ConfirmRegisterComponent
  },
  {
      path: '**',
      component: PageNotFoundComponent
  }
];

export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes, { useHash: true });


//export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);
