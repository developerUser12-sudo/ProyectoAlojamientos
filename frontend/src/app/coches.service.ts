import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from '../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class CochesService {
private apiCochesUrl = environment.apiUrl;
private apiCochesReservadosUrl = environment.apiUrl;
  constructor(private http: HttpClient) { }
   getCoches(): Observable<any> {
    return this.http.get(`${this.apiCochesUrl}/api/coches`);
  }
  getCoche(id:string): Observable<any> {
     let params = new HttpParams();

    params = params.set('id', id);
    return this.http.get(`${this.apiCochesUrl}/api/coches/filtrar`,{params});
  }
  getCochesBusqueda(origen: string, destino: string, marca: string, modelo: string, precio_min: number, precio_max: number) {
    let params = new HttpParams();

    params = params.set('origen', origen);
    params = params.set('destino', destino);
    if (marca) {
      params = params.set('marca', marca);
    }
    if (modelo) {
      params = params.set('modelo', modelo);
    }
    if (precio_min) {
      params = params.set('precio_min', precio_min.toString());
    }
    if (precio_max) {
      params = params.set('precio_max', precio_max.toString());
    }

    return this.http.get(`${this.apiCochesUrl}/api/coches/filtrar`, { params });
  }
  
  reservarCoche(idCoche:string|null,idUsuario:number,fechaSalida:Date){
    let datos=
      {id_coche:Number(idCoche),id_usuario:idUsuario,fecha_salida:fechaSalida.toISOString().substring(0, 10)}
    ;
      console.log(datos);
      
    return this.http.post(`${this.apiCochesReservadosUrl}/api/coches-reservados`,datos);
  }


}
