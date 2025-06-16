import { Component } from '@angular/core';
import { BienvenidaComponent } from '../bienvenida/bienvenida.component';
import { Options } from '@angular-slider/ngx-slider';
import { HotelesService } from '../hoteles.service';
import { Hotel } from '../hotel';
import { HabitacionesService } from '../habitaciones.service';
import { Habitacion } from '../habitacion';
import { NgForm } from '@angular/forms';

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
  hora_apertura = '';
  hora_cierre = '';
  nombre = '';
  estrellas: number | null = null;
  localizacion = '';
  comidas = [];
  hoteles: Hotel[] = [];
  habitaciones: Habitacion[] = [];
  opcionesSeleccionadas: string[] = [];
  buscado: boolean = false;
  filtrar: any = [];
  descuento = false;
  agotado=false;
  masBarata: Habitacion | null = null;
  constructor(private serviciosService: HotelesService, private habitacionService: HabitacionesService) { }
  ngOnInit(): void {
    this.cargando = 'Cargando...';
    this.habitacionService.getHabitaciones().subscribe((data) => {
      this.habitaciones = data;

    });
    setTimeout(() => {
      this.serviciosService.getHoteles().subscribe((data) => {
        this.cargando = '';
        this.hoteles = data;

      });
    }, 3000);
  }
  limpiarFormulario(form: NgForm) {
    form.resetForm();
    this.nombre = '';
    this.localizacion = '';
    this.comidas = [];
    this.hora_apertura = '';
    this.hora_cierre = '';
    this.minValue = 0;
    this.maxValue = 1000;
    this.buscado = false;
    this.filtrar = [];
  }
  stars(n: number): any[] {
    return Array(n);
  }
  precioHabitacion(id: number) {
    let precios: number[] = [];
    this.descuento = false;
    this.masBarata;
    for (let index = 0; index < this.habitaciones.length; index++) {
      if (this.habitaciones[index].hotel_id == id) {
        precios.push(this.habitaciones[index].precio_noche);
      }
      if (this.habitaciones[index].descuento > 0) {
        this.descuento = true;
      }
    }
    for (let index = 0; index < this.habitaciones.length; index++) {
      if (this.habitaciones[index].precio_noche == Math.min(...precios)) {
        this.masBarata = this.habitaciones[index];
      }

    }
    return this.masBarata;

  }
  habitacionesDisponibles(id: number) {
    this.agotado=false;
    for (let index = 0; index < this.habitaciones.length; index++) {
      if (this.habitaciones[index].hotel_id == id) {
        if (this.habitaciones[index].disponibles==0) {
          
          this.agotado=true;
        }else{
          this.agotado=false;
        }
      }
    }
  }
  onSubmit() {

    this.buscado = true;
    console.log(this.opcionesSeleccionadas);
    
    this.serviciosService.getHotelesBusqueda(this.nombre, this.localizacion, this.estrellas, this.hora_apertura, this.hora_cierre, this.minValue, this.maxValue, this.opcionesSeleccionadas).subscribe(data => {
      this.filtrar = data;


    });
  }
}
