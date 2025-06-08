import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { HotelesService } from '../hoteles.service';
import { HabitacionesService } from '../habitaciones.service';
import { UsuarioService } from '../usuario.service';
import { CochesService } from '../coches.service';

@Component({
  selector: 'app-metodopago',
  standalone: false,
  templateUrl: './metodopago.component.html',
  styleUrl: './metodopago.component.css'
})
export class MetodopagoComponent {
  constructor(private cocheDetalle: CochesService, private route: ActivatedRoute, private habitacionService: HabitacionesService, private usuario: UsuarioService, private router: Router) { }
  reserva: any = {};
  metodoPago: string = '';
  numeroTarjeta: string = '';
  reservado:boolean=false;

  ngOnInit() {
    this.route.queryParams.subscribe(params => {
      if (params['habitacionId'] && +params['habitacionId'] > 0) {

        this.reserva = {
          habitacionId: +params['habitacionId'],
          usuarioId: +params['usuarioId'],
          entrada: params['entrada'],
          salida: params['salida'],
          comida: params['comida']
        };
      } else {
        this.reserva = {
          idCoche: +params['idCoche'],
          usuarioId: +params['usuarioId'],
          inicio: params['inicio']
        };
      }
    });
  }
 
  onSubmit() {
    this.reservado=false;
    if (this.reserva.habitacionId > 0) {
      this.habitacionService.reservarHabitacion(this.reserva.habitacionId, this.reserva.usuarioId, this.reserva.entrada, this.reserva.salida, this.reserva.comida, this.metodoPago).subscribe({
        next: () => {
          this.reservado=true;
        }
      });
      
    } else {
      
      this.cocheDetalle.reservarCoche(this.reserva.idCoche, this.reserva.usuarioId, this.reserva.inicio, this.metodoPago).subscribe({
        next: () => {
          this.reservado=true;
          
        }

      });
    }
  }
  isFormValid(): boolean {
    return !!(
      this.numeroTarjeta ||
      this.metodoPago == 'efectivo'
    );
  }

}
