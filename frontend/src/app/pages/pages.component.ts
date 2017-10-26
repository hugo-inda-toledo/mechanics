import { Component, ViewEncapsulation } from '@angular/core';
import { Location } from '@angular/common';

import { AppState } from '../app.state';

declare var Pace:any;

@Component({
    selector: 'pages',
    encapsulation: ViewEncapsulation.None,
    providers: [AppState],
    styleUrls: ['./pages.scss'],
    template: `
        <navbar></navbar>
        <div class="container-fluid">
            <div class="row">
                <sidebar></sidebar>
                <div class="main-wrapper"  [ngClass]="{'menu-collapsed': isMenuCollapsed}" >
                    <div class="az-overlay" *ngIf="!isMenuCollapsed" (click)="hideMenu()"></div>

                    <div class="main">
                        <breadcrumb></breadcrumb>
                        <router-outlet></router-outlet>
                    </div>

                    <!--<footer class="footer text-xs-center clearfix">
                       <div class="footer-main pull-left  clearfix">
                            <div class="copyright pull-left">&copy; <a class="font-weight-bold" href="http://themeseason.com">ThemeSeason</a> 2016</div>
                            <ul class="share clearfix pull-left">
                                <li><a href="https://www.facebook.com/themeseason" target="_blank"><i class="socicon socicon-facebook transition"></i></a></li>
                                <li><a href="https://twitter.com/themeseason" target="_blank"><i class="socicon socicon-twitter transition"></i></a></li>
                                <li><a href="https://www.instagram.com/themeseason" target="_blank"><i class="socicon socicon-instagram transition"></i></a></li>
                                <li><a href="https://www.pinterest.com/themeseason" target="_blank"><i class="socicon socicon-pinterest transition"></i></a></li>
                            </ul>
                        </div>


                       <div class="pull-right created">Created with <i class="ion-heart"></i></div>

                    </footer>-->

                    <back-top position="200"></back-top>

                </div>
            </div>
        </div>
    `
})

export class PagesComponent {
    isMenuCollapsed:boolean = false;

    constructor(private _state:AppState, private _location:Location) {
        this._state.subscribe('menu.isCollapsed', (isCollapsed) => {
            this.isMenuCollapsed = isCollapsed;
        });
    }

    ngOnInit() {
        this.getCurrentPageName();

        Pace.on('done', function() {
          console.log('loaded');
        });
    }


    getCurrentPageName():void{
        var url = this._location.path();
       // var currentPage = url.substring(url.lastIndexOf('/') + 1);
        //this._state.notifyDataChanged('menu.activeLink', currentPage);
        setTimeout(function(){
            window.scrollTo(0, 0);
            jQuery('a[href="#' + url + '"]').closest("li").closest("ul").closest("li").addClass("sidebar-item-expanded");
        });
    }

     public hideMenu():void{
         this._state.notifyDataChanged('menu.isCollapsed', true);
     }


}
