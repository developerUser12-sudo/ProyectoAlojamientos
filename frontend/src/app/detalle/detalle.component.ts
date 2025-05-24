  import { Component } from '@angular/core';
  import { ActivatedRoute } from '@angular/router';
  import { Coche } from '../coche';
  import { CochesService } from '../coches.service';
  import { UsuarioService } from '../usuario.service';
  import { environment } from '../../environments/environment';

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
    diferenciaDias: boolean = false;
    reservado: boolean = false;
    diaIncorrecto: boolean = false;
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

      this.usuario.getUsuario().subscribe((dataUsuario) => {
        if (dataUsuario.username == 'invitado') {
          window.location.href = environment.apiUrl;

        } else {
          let now=new Date();
          let inicio = new Date(this.fechaInicio);
          let fin = new Date(this.fechaFin);
          let diffMsNow = inicio.getTime() - now.getTime();
          let diffDiasNow = diffMsNow / (1000 * 60 * 60 * 24);
          if (inicio < now||diffDiasNow<3) {
            this.diaIncorrecto = true;
            this.diferenciaDias = false;
            this.reservado = false;
          } else {
            
            let diffMs = fin.getTime() - inicio.getTime();
            let diffDias = diffMs / (1000 * 60 * 60 * 24);
            if (diffDias > 20 || diffDias < 1) {
              this.diferenciaDias = true;
              this.diaIncorrecto = false;
              this.reservado = false;

            } else {
              if (this.coche) {

                this.precio = parseFloat(this.coche.precio) * diffDias;
              }
              let idCoche = this.route.snapshot.paramMap.get('id');


              this.cocheDetalle.reservarCoche(idCoche, dataUsuario.id, inicio, fin, this.precio)
                .subscribe(() => {
                  this.diferenciaDias = false;
                  this.reservado = true;
                  this.diaIncorrecto = false;
                });



            }
          }
        }
      });
    }
  }