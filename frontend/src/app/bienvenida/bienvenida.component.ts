import { Component } from '@angular/core';
import { Coche } from '../coche';
import { ServiciosService } from '../servicios.service';

@Component({
  selector: 'app-bienvenida',
  standalone: false,
  templateUrl: './bienvenida.component.html',
  styleUrl: './bienvenida.component.css'
})
export class BienvenidaComponent {
  
  coches : Coche[] = [];
    constructor(private serviciosService: ServiciosService) { }
  
    ngOnInit(): void {
      this.serviciosService.getCoches().subscribe((data) => {
        this.coches = data;
  
      });
    }
  
  
}
