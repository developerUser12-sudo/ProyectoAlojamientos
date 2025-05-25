import { Component } from '@angular/core';
import { environment } from '../../environments/environment';
import { ActivatedRoute } from '@angular/router';
import { CochesService } from '../coches.service';
import { UsuarioService } from '../usuario.service';
import { Coche } from '../coche';
@Component({
  selector: 'app-detallecoche',
  standalone: false,
  templateUrl: './detallecoche.component.html',
  styleUrl: './detallecoche.component.css'
})
export class DetallecocheComponent {
  coche: Coche | null = null;
  fechaInicio: Date = new Date();
  coches: Coche[] = [];
  id: number = 0;
  precio: number = 0;
  reservado = false;
  diaIncorrecto = false;
  faltaLugar = false;
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
    this.reservado = false;
    this.diaIncorrecto = false;
    this.faltaLugar = false;  
    this.usuario.getUsuario().subscribe((dataUsuario) => {
      if (dataUsuario.username == 'invitado') {
        window.location.href = environment.apiUrl;
      } else {
        let now = new Date();
        let inicio = new Date(this.fechaInicio);
        let diffMsNow = inicio.getTime() - now.getTime();
        let diffDiasNow = diffMsNow / (1000 * 60 * 60 * 24);
        if (inicio < now || diffDiasNow < 3) {
          this.diaIncorrecto = true;

        } else {
          let idCoche = this.route.snapshot.paramMap.get('id');
          this.cocheDetalle.reservarCoche(idCoche, dataUsuario.id, inicio)
            .subscribe(() => {

              this.reservado = true;
            });
        }
      }
    });
  }
}
