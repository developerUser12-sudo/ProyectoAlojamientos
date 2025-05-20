import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Coche } from '../coche';
import { CochesService } from '../coches.service';

@Component({
  selector: 'app-detalle',
  standalone: false,
  templateUrl: './detalle.component.html',
  styleUrl: './detalle.component.css'
})
export class DetalleComponent {
  coche: Coche | null = null;
  constructor(private route: ActivatedRoute, private cocheDetalle: CochesService) { }
  ngOnInit(): void {
  let id = this.route.snapshot.paramMap.get('id');
  if (id) {
    this.cocheDetalle.getCoche(id).subscribe((data) => {
      this.coche = data[0];
      console.log(this.coche);
      
    });
  } 
}
}
