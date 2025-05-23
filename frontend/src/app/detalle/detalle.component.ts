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
  precio: number = 0;
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
    let salir = false;
    let inicio = new Date(this.fechaInicio);
    let fin = new Date(this.fechaFin);
    let diffMs = fin.getTime() - inicio.getTime();
    let diffDias = diffMs / (1000 * 60 * 60 * 24);
    if (diffDias > 20 || diffDias < 1) {
      this.errorFecha = true;
      this.noDisponible = false;
    } else {
      if (this.coche) {

        this.precio = parseFloat(this.coche.precio) * diffDias;
      }

      let idCoche = this.route.snapshot.paramMap.get('id');
      this.usuario.getUsuario().subscribe((dataUsuario) => {

        this.cocheDetalle.reservarCoche(idCoche, dataUsuario.id, this.fechaInicio, this.fechaFin, this.precio)
          .subscribe(() => {
            this.errorFecha = false;
            this.reservado = true;
          });

      });
    }
  }
}