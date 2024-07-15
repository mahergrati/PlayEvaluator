import { Component } from '@angular/core';
import { LayoutService } from 'src/app/layout/service/app.layout.service';
import { DataService } from 'src/app/demo/service/data.service';
import { Router } from '@angular/router';


@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styles: [`
        :host ::ng-deep .pi-eye,
        :host ::ng-deep .pi-eye-slash {
            transform: scale(1.6);
            margin-right: 1rem;
            color: var(--primary-color) !important;
        }
    `]
})
export class LoginComponent {
    showRegistration: boolean = false;
    email: string = '';
    password: string = '';
    error: string | null = null;

    constructor(public layoutService: LayoutService, private dataService: DataService, private router: Router) {}

    showRegistrationForm() {
        this.showRegistration = true;
    }

    login() {
        this.dataService.login(this.email, this.password).subscribe(
            response => {
                this.dataService.setToken(response.token);
                this.router.navigate(['/']); // Redirection après une connexion réussie
            },
            err => {
                this.error = 'Invalid credentials';
            }
        );
    }

    logout() {
        this.dataService.logout();
        this.router.navigate(['/login']); // Redirection vers la page de connexion après déconnexion
    }

    isLoggedIn(): boolean {
        return this.dataService.isLoggedIn();
    }
    onRegistrationSubmit() {
        this.showRegistration = false;
    }

}
