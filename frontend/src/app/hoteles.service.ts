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
    getHotelesBusqueda(nombre: string, localizacion: string, estrellas: number|null, fecha_apertura: string, fecha_cierre: string, precio_min: number, precio_max: number,opcionesSeleccionadas:string[]) {
      let params = new HttpParams();
      if (nombre) {
        
        params = params.set('nombre', nombre);
      }
      if (localizacion) {
        
        params = params.set('localizacion', localizacion);
      }
      if (estrellas) {
        params = params.set('estrellas', estrellas);
      }
      if (fecha_apertura) {
        params = params.set('hora_apertura', fecha_apertura);
      }
      if (fecha_cierre) {
        params = params.set('hora_cierre', fecha_cierre);
        
      }

      if (precio_min) {
        params = params.set('precio_min', precio_min.toString());
      }
      if (precio_max) {
        params = params.set('precio_max', precio_max.toString());
      }
      if (opcionesSeleccionadas) {
        params = params.set('comidas', opcionesSeleccionadas.join(','));
        
      }

      return this.http.get(`${this.apiHotelesUrl}/api/hoteles/filtrar`, { params });
    }
  }
