import { Component } from '@angular/core';
import { SesionService } from './sesion.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  standalone: false,
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'frontend';
  logeado="";
  constructor(private usuario: SesionService) { }
  
    ngOnInit(): void {
      this.usuario.getUsuario().subscribe((data) => {
        console.log(data.name);
        
  
      });
    }
}
