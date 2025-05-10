import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from './user';

@Injectable({
  providedIn: 'root'
})
export class ServiciosService {
  private apiUrl = 'http://127.0.0.1:8000/api/coches';

  constructor(private http: HttpClient) { }

  getCoches(): Observable<any> {
    return this.http.get(this.apiUrl);
  }
  getUsuario() {
    return this.http.get<User>('http://localhost:8000/username', { withCredentials: true });
  }



}
