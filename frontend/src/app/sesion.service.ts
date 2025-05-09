import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class SesionService {
  private apiUrl = 'http://127.0.0.1:8000/api/user';
  constructor(private http: HttpClient) { }
  getUsuario(): Observable<any> {
    return this.http.get(this.apiUrl,{ withCredentials: true });
  }
}
