import { Component } from '@angular/core';
import { ServiciosService } from './servicios.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  standalone: false,
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'frontend';
  logeado = "";
  cargando=true;
  constructor(private auth: ServiciosService) { }

  ngOnInit(): void {
    this.auth.getUsuario().subscribe((data) => {
      this.logeado = data.username;
      this.cargando=false;

    });
  }
  

}
