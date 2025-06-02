import { Injectable } from '@angular/core';
import { environment } from '../environments/environment';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class HabitacionesService {
  private apiHabitacionesUrl = environment.apiUrl;
  constructor(private http: HttpClient) { }
  getHabitacionesById(id: string|null): Observable<any> {
    let params = new HttpParams();
    if (id) {
      params = params.set('hotel_id', id);
    }
    return this.http.get(`${this.apiHabitacionesUrl}/api/habitaciones/filtrar`, { params });
  }
  getHabitaciones(): Observable<any> {

    return this.http.get(`${this.apiHabitacionesUrl}/api/habitaciones`);
  }
  reservarHabitacion(idHabitacion:string|null,idUsuario:number,fechaEntrada:string,fechaSalida:string,comida:string){
    
    let datos=
      {habitacion_id:Number(idHabitacion),id_usuario:idUsuario,fecha_salida:fechaSalida,fecha_entrada:fechaEntrada,comida:comida}
    ;      
    
    return this.http.post(`${this.apiHabitacionesUrl}/api/habitaciones-reservadas`,datos);
  }
}
