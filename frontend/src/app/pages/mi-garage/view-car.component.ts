import { Component, ViewEncapsulation, OnInit, OnDestroy } from '@angular/core';
import { CarsService } from '../../modelCtlr/cars.service';
import { Car } from '../../models/car.model';
import { Http, Headers, RequestOptions, Response, ResponseContentType } from '@angular/http';

import { Router } from '@angular/router';
import { Location } from '@angular/common';
import { ActivatedRoute } from '@angular/router';
import { ServerConfig } from '../../app.server.config';

import { StatusRequest  } from '../../services/status.requests';
import { AuthenticationService } from '../../auth/authentication.service';
import { PdfViewerComponent } from 'ng2-pdf-viewer';

import * as FileSaver from 'file-saver';

@Component({
  selector: 'view-car',
  encapsulation: ViewEncapsulation.None,
  templateUrl: 'view-car.html'
})

export class ViewCarComponent implements OnInit, OnDestroy {
    public token_url: string;
    public http_reports: string;
    public id: number;
    public car: any;
    public estados: any;

    private sub: any;
    public loading = false;
    public error = '';
    public router: Router;

    public dataModal: { src: any };

    constructor(
        private http: Http,
        private carsService: CarsService,
        private authenticationService: AuthenticationService,
        router:Router,
        private _location: Location,
        private activateRoute: ActivatedRoute

      ) {
        this.router = router;

        this.estados= StatusRequest;
    }

    ngOnInit() {
      // get car
      let _self= this;
      this.sub = this.activateRoute.params.subscribe(params => {
         _self.id = +params['id']; // (+) converts string 'id' to a number
         _self.getCar(_self.id);

      });
    }

    getCar(idCar){
      this.carsService.getCar(idCar)
         .subscribe(response => {
             this.car = response.data;
             console.log(this.car);
             this.token_url = this.authenticationService.getToken();
             this.http_reports = ServerConfig.url+'/api/reports';
         });
    }

    backClicked() {
        this._location.back();
    }

    ngOnDestroy() {
      this.sub.unsubscribe();
    }

    downloadPDF(request_id): any {
      return this.http.get( this.http_reports+'/payment_voucher/'+this.car.id +'/'+ request_id +'/'+ this.token_url, { responseType: ResponseContentType.Blob }).map(
      (res) => {
          return new Blob([res.blob()], { type: 'application/pdf' })
      });
    }

    tryDownload(request_id){
      this.dataModal={ src : ''};
      this.downloadPDF(request_id).subscribe((data)=>{
        var fileURL = URL.createObjectURL(data);
        this.dataModal.src= fileURL;
        document.getElementById("modal_success_general").click();
      });
    }

    try(request_id){
      this.dataModal={ src : ''};
      this.dataModal.src = this.http_reports+'/payment_voucher/'+this.car.id +'/'+ request_id +'/'+ this.token_url;
      document.getElementById("modal_success_general").click();
    }

    callBackFn(pdf: PDFDocumentProxy) {
      console.log(pdf);
       // do anything with "pdf"
    }
}
