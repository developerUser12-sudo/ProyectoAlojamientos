import { Component } from '@angular/core';
import { Hotel } from '../hotel';
import { ActivatedRoute } from '@angular/router';
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
  fecha_salida: Date = new Date();
  fecha_entrada: Date = new Date();
  comida: string = '';
  rangoIncorrecto: boolean = false;
  reservado: boolean = false;
  diaSalidaIncorrecto: boolean = false;
  idHabitacion: number = 0;
  faltaComida: boolean = false;
  constructor(private route: ActivatedRoute, private hotelDetalle: HotelesService, private habitacionService: HabitacionesService, private usuario: UsuarioService) { }
  ngOnInit(): void {
    let id = this.route.snapshot.paramMap.get('id');
    this.habitacionService.getHabitacionesById(id).subscribe((data) => {
      this.habitaciones = data;

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

        }

      });
    }
  }
  stars(n: number): any[] {
    return Array(n);
  }
  onSubmit() {
    this.diaSalidaIncorrecto = false;
    this.rangoIncorrecto = false;
    let hoy = new Date();
    hoy.setHours(0, 0, 0, 0);
    let entrada = new Date(this.fecha_entrada);
    entrada.setHours(0, 0, 0, 0);
    if (this.fecha_entrada == this.fecha_salida || this.fecha_salida < this.fecha_entrada) {
      this.rangoIncorrecto = true;
    }
    else if (entrada <= hoy) {
      this.diaSalidaIncorrecto = true;
    }
    else if (this.comida == '') {
      this.faltaComida = true;
    }
    else {
      this.usuario.getUsuario().subscribe((dataUsuario) => {
        if (dataUsuario.username == 'invitado') {
          window.location.href = environment.apiUrl;
        }
        else {
          if (this.habitacionSeleccionada) {
            const entradaDate = new Date(this.fecha_entrada);
            const salidaDate = new Date(this.fecha_salida);

            const fechaEntradaStr = entradaDate.toISOString().slice(0, 10);
            const fechaSalidaStr = salidaDate.toISOString().slice(0, 10);

            this.habitacionService.reservarHabitacion(
              this.habitacionSeleccionada.id,
              dataUsuario.id,
              fechaEntradaStr,
              fechaSalidaStr,
              this.comida
            ).subscribe({
              next: () => {
                this.reservado = true;
              }
            });



          }
        }
      });
    }
  }

}
