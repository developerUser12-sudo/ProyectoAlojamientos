import { Component } from '@angular/core';
import { BienvenidaComponent } from '../bienvenida/bienvenida.component';
import { Options } from '@angular-slider/ngx-slider';
import { HotelesService } from '../hoteles.service';
import { Hotel } from '../hotel';

@Component({
  selector: 'app-hoteles',
  standalone: false,
  templateUrl: './hoteles.component.html',
  styleUrl: './hoteles.component.css'
})
export class HotelesComponent {
  cargando: string = '';
  minValue: number = 0;
  maxValue: number = 1000;
  options: Options = {
    floor: 0,
    ceil: 1000,
    step: 10,
    translate: (value: number): string => {
      return '€' + value;
    }
  };
  hoteles: Hotel[] = [];
  constructor(private serviciosService: HotelesService) { }
  ngOnInit(): void {
    this.cargando = 'Cargando...';
    setTimeout(() => {
      this.serviciosService.getHoteles().subscribe((data) => {
        this.cargando = '';
        this.hoteles = data;

      });
    }, 3000);
  }
  stars(n:number): any[]{
    return Array(n);
  }
}
