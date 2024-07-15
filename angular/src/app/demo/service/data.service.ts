import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class DataService {
    private baseUrl = 'http://127.0.0.1:8000/api';

    constructor(private http: HttpClient) {}

    login(email: string, password: string): Observable<any> {
        return this.http.post<any>(`${this.baseUrl}/login`, { email, password });
    }

    setToken(token: string): void {
        localStorage.setItem('jwtToken', token);
    }

    getToken(): string | null {
        return localStorage.getItem('jwtToken');
    }

    logout(): void {
        localStorage.removeItem('jwtToken');
    }

    isLoggedIn(): boolean {
        return this.getToken() !== null;
    }

    UserRegister(data: any): Observable<any> {
        const headers = new HttpHeaders({
            'Content-Type': 'application/json'
        });
        return this.http.post<any>(`${this.baseUrl}/adduser`, JSON.stringify(data), { headers });
    }

    getData(): Observable<any> {
        const token = this.getToken();
        if (token) {
            const headers = new HttpHeaders({
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            });
            return this.http.get<any>(`${this.baseUrl}/data`, { headers });
        } else {
            throw new Error('No token found');
        }
    }
}
