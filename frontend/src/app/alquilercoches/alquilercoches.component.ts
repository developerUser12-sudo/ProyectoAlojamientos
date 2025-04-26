import { Component } from '@angular/core';
import { ServiciosService } from '../servicios.service';

@Component({
  selector: 'app-alquilercoches',
  standalone: false,
  templateUrl: './alquilercoches.component.html',
  styleUrl: './alquilercoches.component.css'
})
export class AlquilercochesComponent {
  coches = [];
  constructor(private serviciosService: ServiciosService) { }

  ngOnInit(): void {
    this.serviciosService.getCoches().subscribe((data) => {
      this.coches = data;

    });
  }
}
