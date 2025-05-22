import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Coche } from '../coche';
import { CochesService } from '../coches.service';
import { UsuarioService } from '../usuario.service';

@Component({
  selector: 'app-detalle',
  standalone: false,
  templateUrl: './detalle.component.html',
  styleUrl: './detalle.component.css'
})
export class DetalleComponent {
  coche: Coche | null = null;
  fechaInicio: Date = new Date();
  fechaFin: Date = new Date();
  coches: Coche[] = [];
  id: number = 0;

  constructor(private route: ActivatedRoute, private cocheDetalle: CochesService, private usuario: UsuarioService) { }
  ngOnInit(): void {
    let id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.cocheDetalle.getCoche(id).subscribe((data) => {
        this.coche = data[0];

      });
    }
  }
  onSubmit() {
    this.cocheDetalle.cochesReservados().subscribe((data) => {
      let idCoche = this.route.snapshot.paramMap.get('id');
      if (data.length == 0) {
        this.usuario.getUsuario().subscribe((data) => {
          this.cocheDetalle.reservarCoche(idCoche, data.id, this.fechaInicio, this.fechaFin).subscribe(response => {
            console.log('Reserva realizada', response);
          }, error => {
            console.error('Error al reservar', error);
          });;

        });
      } else {


        for (let index = 0; index < data.length; index++) {
          console.log("data[index].fecha_recogid");

          if (idCoche == data[index].id_coche && (this.fechaInicio > data[index].fecha_recogida && this.fechaInicio < data[index].fecha_devolucion)) {
            console.log("si");

          } else {
          }
        }
      }

    });
  }
}
