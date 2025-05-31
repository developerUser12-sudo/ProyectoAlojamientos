import { Injectable } from '@angular/core';
import { environment } from '../environments/environment';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class HotelesService {
  private apiHotelesUrl = environment.apiUrl;
  constructor(private http: HttpClient) { }
  getHoteles(): Observable<any> {
    return this.http.get(`${this.apiHotelesUrl}/api/hoteles`);
  }
  getHotel(id:string): Observable<any> {
     let params = new HttpParams();

    params = params.set('id', id);
    return this.http.get(`${this.apiHotelesUrl}/api/hoteles/filtrar`,{params});
  }
}
