import { Component } from '@angular/core';
import { environment } from '../environments/environment'; 
import { UsuarioService } from './usuario.service';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  standalone: false,
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'frontend';
  logeado = "Cargando...";
  constructor(private auth: UsuarioService) { }

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
