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
  fechaInicio: string = '';
  fechaFin: string = '';
  coches: Coche[] = [];
  id: number = 0;
  noDisponible: boolean = false;
  errorFecha: boolean = false;
  reservado: boolean = false;
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
    let inicio = new Date(this.fechaInicio);
    let fin = new Date(this.fechaFin); 
    if (inicio < fin) {
      this.errorFecha = true;
      this.noDisponible = false;
    } else {
      this.cocheDetalle.cochesReservados().subscribe((data) => {
        let idCoche = this.route.snapshot.paramMap.get('id');
        this.usuario.getUsuario().subscribe((dataUsuario) => {
          if (data.length == 0) {
            this.cocheDetalle.reservarCoche(idCoche, dataUsuario.id, inicio, fin).subscribe(response => {
              this.noDisponible = false;
              this.errorFecha = false;
              this.reservado = true;
            });;

          } else {
            for (let index = 0; index < data.length; index++) {
              if (idCoche == data[index].id_coche && (inicio >= data[index].fecha_recogida && inicio <= data[index].fecha_devolucion) || (fin >= data[index].fecha_recogida && fin <= data[index].fecha_devolucion)) {
                this.noDisponible = true;
                this.errorFecha = false;
              } else {
                this.cocheDetalle.reservarCoche(idCoche, dataUsuario.id, inicio, fin).subscribe(response => {
                  this.reservado = true;
                  this.noDisponible = false;
                  this.errorFecha = false;

                });
              }
            }
          }
        });


      });
    }
  }
}
