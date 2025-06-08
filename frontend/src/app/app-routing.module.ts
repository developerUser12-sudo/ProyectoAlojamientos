import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BienvenidaComponent } from './bienvenida/bienvenida.component';
import { HotelesComponent } from './hoteles/hoteles.component';
import { NoencontradoComponent } from './noencontrado/noencontrado.component';
import { CochesComponent } from './coches/coches.component';
import { DetallecocheComponent } from './detallecoche/detallecoche.component';
import { DetallehotelComponent } from './detallehotel/detallehotel.component';
import { SobrenosotrosComponent } from './sobrenosotros/sobrenosotros.component';
import { TerminosdeservicioComponent } from './terminosdeservicio/terminosdeservicio.component';
import { PreguntasfrecuentesComponent } from './preguntasfrecuentes/preguntasfrecuentes.component';
import { PoliticadeprivacidadComponent } from './politicadeprivacidad/politicadeprivacidad.component';
import { PoliticadecookiesComponent } from './politicadecookies/politicadecookies.component';
import { InformaciondelaempresaComponent } from './informaciondelaempresa/informaciondelaempresa.component';
import { SoporteComponent } from './soporte/soporte.component';
import { MetodopagoComponent } from './metodopago/metodopago.component';

const routes: Routes = [
  {path:'',component:BienvenidaComponent},
  {path:'bienvenida',component:BienvenidaComponent},
  {path:'hoteles',component:HotelesComponent},
  {path:'coches',component:CochesComponent},
  {path:'detalle-coche/:id',component:DetallecocheComponent},
  {path:'detalle-hotel/:id',component:DetallehotelComponent},
  {path:'sobre-nosotros',component:SobrenosotrosComponent},
  {path:'terminos-de-servicio',component:TerminosdeservicioComponent},
  {path:'preguntas-frecuentes',component:PreguntasfrecuentesComponent},
  {path:'politica-de-privacidad',component:PoliticadeprivacidadComponent},
  {path:'politica-de-cookies',component:PoliticadecookiesComponent},
  {path:'informacion-de-la-empresa',component:InformaciondelaempresaComponent},
  {path:'soporte',component:SoporteComponent},
  {path:'metodopago',component:MetodopagoComponent},

  {path:'**',component:NoencontradoComponent},

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
