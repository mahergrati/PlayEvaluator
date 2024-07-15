import {Component, OnInit} from '@angular/core';
import {DataService} from "../../service/data.service";

@Component({
    selector: 'app-users',
    standalone: true,
    imports: [],
    templateUrl: './users.component.html',
    styleUrl: './users.component.scss'
})
export class UsersComponent implements OnInit {
    users: Object;

    constructor(private dataService: DataService) {
    }

    ngOnInit() {
        this.getUsersdata();
    }

    getUsersdata() {
        this.dataService.getData().subscribe(res => {
            this.users = res;
        });
    }

}
