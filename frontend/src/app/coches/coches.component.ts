import { Options } from '@angular-slider/ngx-slider';
import { Component } from '@angular/core';
import { Coche } from '../coche';
import { CochesService } from '../coches.service';
import { HttpClient } from '@angular/common/http';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-coches',
  standalone: false,
  templateUrl: './coches.component.html',
  styleUrl: './coches.component.css'
})
export class CochesComponent {
  origen = '';
  destino = '';
  marca = '';
  modelo = '';
  cargando: string = '';
  buscado = false;
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
  coches: Coche[] = [];
  filtrar: any = [];
  constructor(private serviciosService: CochesService) { }

  ngOnInit(): void {
    this.cargando = 'Cargando...';
    setTimeout(() => {
      this.serviciosService.getCoches().subscribe((data) => {
        this.cargando = '';
        this.coches = data;

      });
    }, 3000);
  }
  limpiarFormulario(form: NgForm) {
    form.resetForm();
    this.origen = '';
    this.destino = '';
    this.marca = '';
    this.modelo = '';
    this.minValue = 0;
    this.maxValue = 1000;
  }
  onSubmit() {
    this.buscado = true;
    this.serviciosService.getCochesBusqueda(this.origen, this.destino, this.marca, this.modelo, this.minValue, this.maxValue).subscribe(data => {
      this.filtrar = data;
    });
  }
}
