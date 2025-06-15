import { Component } from '@angular/core';
import { Hotel } from '../hotel';
import { ActivatedRoute, Router } from '@angular/router';
import { HotelesService } from '../hoteles.service';
import { UsuarioService } from '../usuario.service';
import { HabitacionesService } from '../habitaciones.service';
import { Habitacion } from '../habitacion';
import { environment } from '../../environments/environment';

@Component({
  selector: 'app-detallehotel',
  standalone: false,
  templateUrl: './detallehotel.component.html',
  styleUrl: './detallehotel.component.css'
})
export class DetallehotelComponent {
  hotel: Hotel | null = null;
  habitaciones: Habitacion[] = [];
  habitacionSeleccionada: Habitacion | null = null;
  fecha_salida: string = '';
  fecha_entrada: string = '';
  comida: string = '';
  rangoIncorrecto: boolean = false;
  idHabitacion: number = 0;
  faltaComida: boolean = false;
  nombreHotel='';
  constructor(private route: ActivatedRoute, private hotelDetalle: HotelesService, private habitacionService: HabitacionesService, private usuario: UsuarioService, private router: Router) { }

  ngOnInit(): void {
    let id = this.route.snapshot.paramMap.get('id');
    this.habitacionService.getHabitacionesById(id).subscribe((data) => {
      this.habitaciones = data;
      for (let habitacion of this.habitaciones) {
        if (typeof habitacion.imagenes === 'string') {
          habitacion.imagenes = JSON.parse(habitacion.imagenes);

        }
      }

    })
    if (id) {
      this.hotelDetalle.getHotel(id).subscribe((data) => {
        this.hotel = data[0];
        if (this.hotel) {
          if (typeof this.hotel.imagenes === 'string') {
            this.hotel.imagenes = JSON.parse(this.hotel.imagenes);
          }

          if (typeof this.hotel.servicios === 'string') {
            this.hotel.servicios = JSON.parse(this.hotel.servicios);
          }

          if (typeof this.hotel.comidas === 'string') {
            this.hotel.comidas = JSON.parse(this.hotel.comidas);
          }
           this.nombreHotel = this.hotel.nombre;

        }

      });
    }
  }
  stars(n: number): any[] {
    return Array(n);
  }
  isFormValid(): boolean {
    return !!(
      this.fecha_entrada &&
      this.fecha_salida &&
      this.habitacionSeleccionada
    );
  }

  onSubmit() {
    
    this.rangoIncorrecto = false;
    let hoy = new Date();
    hoy.setHours(0, 0, 0, 0);
    let entrada = new Date(this.fecha_entrada);
    entrada.setHours(0, 0, 0, 0);
    if (this.fecha_entrada == this.fecha_salida || this.fecha_salida < this.fecha_entrada||entrada<=hoy) {
      this.rangoIncorrecto = true;
    }
    

    else {
      this.usuario.getUsuario().subscribe((dataUsuario) => {
        if (dataUsuario.username == 'invitado') {
          window.location.href = environment.apiUrl;
        }
        else {
          if (this.habitacionSeleccionada) {
            const queryParams: any = {
              habitacionId: this.habitacionSeleccionada.id,
              hotelId: this.hotel?.id,
              usuarioId: dataUsuario.id,
              entrada: this.fecha_entrada,
              salida: this.fecha_salida
            };
            if (this.comida) {
              queryParams.comida = this.comida;
            }
            this.router.navigate(['/metodopago'], { queryParams: queryParams });
          }
        }
      });
    }
  }

}
