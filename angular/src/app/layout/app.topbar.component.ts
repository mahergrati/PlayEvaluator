import { Component, ElementRef, ViewChild } from '@angular/core';
import { MenuItem } from 'primeng/api';
import { LayoutService } from "./service/app.layout.service";
import { DataService } from "../demo/service/data.service";
import {Router} from "@angular/router";

@Component({
    selector: 'app-topbar',
    templateUrl: './app.topbar.component.html'
})
export class AppTopBarComponent {

    items!: MenuItem[];

    @ViewChild('menubutton') menuButton!: ElementRef;

    @ViewChild('topbarmenubutton') topbarMenuButton!: ElementRef;

    @ViewChild('topbarmenu') menu!: ElementRef;
    constructor(public layoutService: LayoutService, private dataService: DataService, private router: Router) {}

    logout() {
        this.dataService.logout();
        this.router.navigate(['/login']); // Redirection vers la page de connexion après déconnexion
    }

    isLoggedIn(): boolean {
        return this.dataService.isLoggedIn();
    }

}
