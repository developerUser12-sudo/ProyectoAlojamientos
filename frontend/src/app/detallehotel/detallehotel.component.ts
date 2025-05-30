import { Component } from '@angular/core';
import { Hotel } from '../hotel';
import { ActivatedRoute } from '@angular/router';
import { HotelesService } from '../hoteles.service';
import { UsuarioService } from '../usuario.service';

@Component({
  selector: 'app-detallehotel',
  standalone: false,
  templateUrl: './detallehotel.component.html',
  styleUrl: './detallehotel.component.css'
})
export class DetallehotelComponent {
  hotel: Hotel | null = null;
  constructor(private route: ActivatedRoute, private hotelDetalle: HotelesService, private usuario: UsuarioService) { }
  ngOnInit(): void {
    let id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.hotelDetalle.getHotel(id).subscribe((data) => {
        this.hotel = data[0];
        if (this.hotel) {
          if (typeof this.hotel.imagenes === 'string') {
            this.hotel.imagenes = JSON.parse(this.hotel.imagenes);
          }

          if (typeof this.hotel.servicios === 'string') {
            this.hotel.servicios = JSON.parse(this.hotel.servicios);
          }
          
          if (typeof this.hotel.comidas === 'string') {
            this.hotel.comidas = JSON.parse(this.hotel.comidas);
          }

        }

      });
    }
  }
  stars(n: number): any[] {
    return Array(n);
  }
}
