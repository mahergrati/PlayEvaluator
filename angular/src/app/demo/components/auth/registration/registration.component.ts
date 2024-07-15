import {Component, EventEmitter, Output} from '@angular/core';
import {LayoutService} from "../../../../layout/service/app.layout.service";
import {Router, RouterLink} from "@angular/router";
import {CheckboxModule} from "primeng/checkbox";
import {FormsModule} from "@angular/forms";
import {PasswordModule} from "primeng/password";
import {ButtonModule} from "primeng/button";
import {InputTextModule} from "primeng/inputtext";
import {RippleModule} from "primeng/ripple";
import {DataService} from "../../../service/data.service";

@Component({
    selector: 'app-registration',
    standalone: true,
    imports: [
        RouterLink,
        CheckboxModule,
        FormsModule,
        PasswordModule,
        ButtonModule,
        InputTextModule,
        RippleModule
    ],
    templateUrl: './registration.component.html',
    styleUrl: './registration.component.scss'
})
export class RegistrationComponent {
    @Output() onSubmit: EventEmitter<any> = new EventEmitter();
    valCheck: string[] = ['remember'];
    password!: string;
    name: string = '';
    lastName: string = '';
    birthday: Date;
    cin: string = '';
    phoneNumber: string = '';
    email: string = '';
    role: string = '';

    constructor(public layoutService: LayoutService, private dataService: DataService, private router: Router) {
    }

    submitRegistration() {
        const registrationData = {
            name: this.name,
            lastname: this.lastName,
            birthday: this.birthday,
            cin: this.cin,
            phone_number: this.phoneNumber,
            email: this.email,
            password: this.password,
            role: this.role
        };

        this.dataService.UserRegister(registrationData).subscribe(
            response => {
                console.log('User registered successfully', response);
                this.dataService.setToken(response.token);
                this.router.navigate(['/']); // Redirection après une inscription réussie
            },
            error => {
                console.error('Error registering user', error);
                if (error.status === 400) {
                    console.log('Validation failed:', error.error);
                    // Gérer les erreurs de validation côté frontend si nécessaire
                } else {
                    console.error('Server error:', error);
                    // Afficher un message d'erreur générique ou rediriger vers une page d'erreur
                }
            }
        );
    }

}




