import { Component } from '@angular/core';
import { BienvenidaComponent } from '../bienvenida/bienvenida.component';
import { Options } from '@angular-slider/ngx-slider';
import { HotelesService } from '../hoteles.service';
import { Hotel } from '../hotel';
import { HabitacionesService } from '../habitaciones.service';
import { Habitacion } from '../habitacion';

@Component({
  selector: 'app-hoteles',
  standalone: false,
  templateUrl: './hoteles.component.html',
  styleUrl: './hoteles.component.css'
})
export class HotelesComponent {
  cargando: string = '';
  minValue: number = 0;
  maxValue: number = 1000;
  options: Options = {
    floor: 0,
    ceil: 1000,
    step: 10,
    translate: (value: number): string => {
      return '€' + value;
    }
  };
  hoteles: Hotel[] = [];
  habitaciones:Habitacion[]=[];
  constructor(private serviciosService: HotelesService,private habitacionService: HabitacionesService) { }
  ngOnInit(): void {
    this.cargando = 'Cargando...';
    this.habitacionService.getHabitaciones().subscribe((data)=>{
      this.habitaciones=data;
      
    });
    setTimeout(() => {
      this.serviciosService.getHoteles().subscribe((data) => {
        this.cargando = '';
        this.hoteles = data;

      });
    }, 3000);
  }
  stars(n:number): any[]{
    return Array(n);
  }
  precioHabitacion(id:number){
    let precios:number[]=[];
    
    for (let index = 0; index < this.habitaciones.length; index++) {
      if (this.habitaciones[index].hotel_id==id) {
        precios.push(this.habitaciones[index].precio_noche);        
      }
    }
    
    return Math.min(...precios); 
  }
}
