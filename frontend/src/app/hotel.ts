import { Time } from "@angular/common";

export interface Hotel {
  id: number;
  nombre: string;
  localizacion: string;
  direccion: string;
  estrellas: number;
  servicios: string[]; 
  imagenes: string[]; 
  capacidad: number;
  comidas:string[];
  hora_apertura: string;
  hora_cierre: string;  
}
