import { Component } from '@angular/core';
import { ServiciosService } from './servicios.service';
import { environment } from '../environments/environment'; 
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  standalone: false,
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'frontend';
  logeado = "Cargando...";
  constructor(private auth: ServiciosService) { }

  ngOnInit(): void {
    setTimeout(() => {
      this.auth.getUsuario().subscribe((data) => {
        this.logeado = data.username;

      });
    }, 3000);
  }
  
   getBackendUrl(): string {
    return `${environment.apiUrl}`;
  }


}
