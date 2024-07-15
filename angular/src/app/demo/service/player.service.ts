import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class PlayerService {
    private apiUrl = 'http://127.0.0.1:8000/api';

    constructor(private http: HttpClient) {}

    getPlayers(): Observable<any> {
        return this.http.get(`${this.apiUrl}/players`);
    }

    savePlayer(playerData: any): Observable<any> {
        return this.http.post(`${this.apiUrl}/playeradd`, playerData);
    }

    updatePlayer(id: number, playerData: any): Observable<any> {
        return this.http.put(`${this.apiUrl}/player/update/${id}`, playerData);
    }

    deletePlayer(id: number): Observable<any> {
        return this.http.delete(`${this.apiUrl}/player/delete/${id}`);
    }
}
