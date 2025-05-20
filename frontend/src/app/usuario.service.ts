import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { User } from './user';
import { environment } from '../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) { }
  getUsuario() {
      return this.http.get<User>(`${this.apiUrl}/username`, { withCredentials: true });
    }
}
