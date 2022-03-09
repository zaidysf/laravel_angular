import { Injectable } from '@angular/core';
import { HttpHeaders, HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators'
@Injectable({
    providedIn: 'root'
})
export class ApiService {

    public authUrl: string = "/api/auth/";

    constructor(private _http: HttpClient) { }

    login(data: { username: string, password: string }) {
        return this._http.post<any>(`${this.authUrl}login`, { 'email': data.username, 'password': data.password })
    }
    logout() {
        return this._http.post<any>(`${this.authUrl}logout`, {}, {headers: new HttpHeaders({
          'Authorization': 'Bearer' + localStorage.getItem('token'),
          'Content-Type': 'application/json'
        })})
    }
}
