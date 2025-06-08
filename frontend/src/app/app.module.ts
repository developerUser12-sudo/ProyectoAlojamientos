import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BienvenidaComponent } from './bienvenida/bienvenida.component';
import { HotelesComponent } from './hoteles/hoteles.component';
import { FormsModule } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { NgxSliderModule } from '@angular-slider/ngx-slider';
import { NoencontradoComponent } from './noencontrado/noencontrado.component';
import { CochesComponent } from './coches/coches.component';
import { DetallecocheComponent } from './detallecoche/detallecoche.component';
import { DetallehotelComponent } from './detallehotel/detallehotel.component';
import { MatSelectModule } from '@angular/material/select';
import { MatFormFieldModule } from '@angular/material/form-field';
import { PreguntasfrecuentesComponent } from './preguntasfrecuentes/preguntasfrecuentes.component';
import { PoliticadecookiesComponent } from './politicadecookies/politicadecookies.component';
import { TerminosdeservicioComponent } from './terminosdeservicio/terminosdeservicio.component';
import { PoliticadeprivacidadComponent } from './politicadeprivacidad/politicadeprivacidad.component';
import { SobrenosotrosComponent } from './sobrenosotros/sobrenosotros.component';
import { InformaciondelaempresaComponent } from './informaciondelaempresa/informaciondelaempresa.component';
import { SoporteComponent } from './soporte/soporte.component';
import { MetodopagoComponent } from './metodopago/metodopago.component';

@NgModule({
  declarations: [

    AppComponent,
    BienvenidaComponent,
    HotelesComponent,
    NoencontradoComponent,
    CochesComponent,
    DetallecocheComponent,
    DetallehotelComponent,
    PreguntasfrecuentesComponent,
    PoliticadecookiesComponent,
    TerminosdeservicioComponent,
    PoliticadeprivacidadComponent,
    SobrenosotrosComponent,
    InformaciondelaempresaComponent,
    SoporteComponent,
    MetodopagoComponent,
    
  ],
  imports: [
    NgxSliderModule,
    ReactiveFormsModule,
    BrowserModule,
    AppRoutingModule,
    HttpClientModule ,
    FormsModule,
    MatFormFieldModule,
    MatSelectModule    
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
