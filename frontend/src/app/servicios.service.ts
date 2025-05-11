import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from './user';
import { environment } from '../environments/environment';


@Injectable({
  providedIn: 'root'
})
export class ServiciosService {
   private apiUrl = environment.apiUrl;
 
  
  constructor(private http: HttpClient) { }
  
 
  getCoches(): Observable<any> {
    return this.http.get(`${this.apiUrl}/api/coches`);
  }
  getUsuario() {
    return this.http.get<User>(`${this.apiUrl}/username`, { withCredentials: true });
  }
  



}
