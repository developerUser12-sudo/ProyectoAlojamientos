import { Injectable } from '@angular/core';
import { environment } from '../environments/environment';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class HotelesService {
private apiCochesUrl = environment.apiUrl;
private apiCochesReservadosUrl = environment.apiUrl;
  constructor(private http: HttpClient) { }
  getHoteles(): Observable<any> {
      return this.http.get(`${this.apiCochesUrl}/api/hoteles`);
    }
}
