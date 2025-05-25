import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BienvenidaComponent } from './bienvenida/bienvenida.component';
import { HotelesComponent } from './hoteles/hoteles.component';
import { NoencontradoComponent } from './noencontrado/noencontrado.component';
import { CochesComponent } from './coches/coches.component';
import { DetallecocheComponent } from './detallecoche/detallecoche.component';

const routes: Routes = [
  {path:'',component:BienvenidaComponent},
  {path:'bienvenida',component:BienvenidaComponent},
  {path:'hoteles',component:HotelesComponent},
  {path:'coches',component:CochesComponent},
  {path:'detalle-coche/:id',component:DetallecocheComponent},
  {path:'**',component:NoencontradoComponent},

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
