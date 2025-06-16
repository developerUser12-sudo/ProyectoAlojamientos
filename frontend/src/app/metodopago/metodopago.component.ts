import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { HotelesService } from '../hoteles.service';
import { HabitacionesService } from '../habitaciones.service';
import { UsuarioService } from '../usuario.service';
import { CochesService } from '../coches.service';
import { Hotel } from '../hotel';
import { Coche } from '../coche';

@Component({
  selector: 'app-metodopago',
  standalone: false,
  templateUrl: './metodopago.component.html',
  styleUrl: './metodopago.component.css'
})
export class MetodopagoComponent {
  constructor(private cocheDetalle: CochesService, private route: ActivatedRoute, private hotelDetalle: HotelesService, private habitacionService: HabitacionesService, private usuario: UsuarioService, private router: Router) { }
  reserva: any = {};
  metodoPago: string = '';
  numeroTarjeta: string = '';
  reservado: boolean = false;
  hotel: Hotel | null = null;
  coche: Coche | null = null;
  caducidad: string = '';
  ccv: number = 0;
  ccvIncorrecto = false;
  fechaIncorrecta = false;
  tarjetaIncorrecta=false;

  ngOnInit() {
    this.route.queryParams.subscribe(params => {
      if (!params['habitacionId'] && !params['idCoche']) {
        this.router.navigate(['/']);

      }
      else {
        if (params['habitacionId'] && +params['habitacionId'] > 0) {

          this.reserva = {

            habitacionId: +params['habitacionId'],
            hotel: params['hotelId'],
            usuarioId: +params['usuarioId'],
            entrada: params['entrada'],
            salida: params['salida'],
            comida: params['comida'] ?? null
          };

          if (this.reserva.hotel) {
            this.hotelDetalle.getHotel(this.reserva.hotel).subscribe((data) => {
              this.hotel = data[0];
              if (this.hotel) {
                if (typeof this.hotel.imagenes === 'string') {
                  this.hotel.imagenes = JSON.parse(this.hotel.imagenes);
                }

              }

            });
          }
        } else {
          this.reserva = {
            idCoche: +params['idCoche'],
            usuarioId: +params['usuarioId'],
            inicio: params['inicio']
          };
          if (this.reserva.idCoche) {
            this.cocheDetalle.getCoche(this.reserva.idCoche).subscribe((data) => {
              this.coche = data[0];

            });
          }
        }
      }

    });
  }



  onSubmit() {
    this.reservado = false;
    this.ccvIncorrecto = false;
    this.fechaIncorrecta=false;
    this.tarjetaIncorrecta=false;
    let hoy = new Date();
    hoy.setHours(0, 0, 0, 0); 
    let caducidadDate = new Date(this.caducidad);
    caducidadDate.setHours(0, 0, 0, 0);
    if (this.ccv&&(this.ccv < 99 || this.ccv > 1000)) {
      this.ccvIncorrecto = true;
    }
    else if (this.caducidad&&caducidadDate <hoy) {
      this.fechaIncorrecta=true;
    }
    else if (this.numeroTarjeta&&!/^\d{16}$/.test(this.numeroTarjeta)) {
      this.tarjetaIncorrecta=true;
    }
    else{
      if (this.reserva.habitacionId > 0) {
      this.habitacionService.reservarHabitacion(this.reserva.habitacionId, this.reserva.usuarioId, this.reserva.entrada, this.reserva.salida, this.reserva.comida, this.metodoPago).subscribe({
        next: () => {
          this.reservado = true;
        }
      });

    } else {

      this.cocheDetalle.reservarCoche(this.reserva.idCoche, this.reserva.usuarioId, this.reserva.inicio, this.metodoPago).subscribe({
        next: () => {
          this.reservado = true;

        }

      });
    }
    }
  }
  isFormValid(): boolean {
    return !!(
      (this.numeroTarjeta && this.caducidad && this.ccv) ||
      this.metodoPago == 'efectivo'
    );
  }

}
