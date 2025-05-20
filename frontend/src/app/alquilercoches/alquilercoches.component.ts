import { Component } from '@angular/core';
import { Coche } from '../coche';
import { Options } from '@angular-slider/ngx-slider';
import { HttpClient } from '@angular/common/http';
import { CochesService } from '../coches.service';

@Component({
  selector: 'app-alquilercoches',
  standalone: false,
  templateUrl: './alquilercoches.component.html',
  styleUrl: './alquilercoches.component.css'
})
export class AlquilercochesComponent {
  origen = '';
  destino = '';
  marca = '';
  modelo = '';
  buscado = false;
  minValue: number = 100;
  maxValue: number = 500;
  options: Options = {
    floor: 0,
    ceil: 1000,
    step: 10,
    translate: (value: number): string => {
      return '€' + value;
    }
  };
  coches: Coche[] = [];
  filtrar: any = [];
  constructor(private serviciosService: CochesService, private http: HttpClient) { }

  ngOnInit(): void {
    this.serviciosService.getCoches().subscribe((data) => {
      this.coches = data;

    });
  }
  onSubmit() {
    this.buscado = true;
    this.serviciosService.getCochesBusqueda(this.origen, this.destino, this.marca, this.modelo, this.minValue, this.maxValue).subscribe(data => {
      this.filtrar = data;
    });
  }


}
