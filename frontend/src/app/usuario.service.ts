import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { User } from './user';
import { environment } from '../environments/environment';
import { Observable, switchMap } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) { }
  getUsuario(): Observable<User> {
    return this.http.get(`${this.apiUrl}/sanctum/csrf-cookie`, { withCredentials: true }).pipe(
      switchMap(() => this.http.get<User>(`${this.apiUrl}/username`, { withCredentials: true }))
    );
  }

}
