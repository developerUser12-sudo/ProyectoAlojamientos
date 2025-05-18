import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
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
  getCochesBusqueda(origen: string, destino: string, marca: string, modelo: string, precio_min?: number, precio_max?: number) {
    let params = new HttpParams();

    if (origen) params = params.set('origen', origen);
    if (destino) params = params.set('destino', destino);
    if (marca) params = params.set('marca', marca);
    if (modelo) params = params.set('modelo', modelo);
    if (precio_min) params = params.set('precio_min', precio_min.toString());
    if (precio_max) params = params.set('precio_max', precio_max.toString());
    
    return this.http.get(`${this.apiUrl}/api/coches/filtrar`, { params });  
  }

  getUsuario() {
    return this.http.get<User>(`${this.apiUrl}/username`, { withCredentials: true });
  }




}
