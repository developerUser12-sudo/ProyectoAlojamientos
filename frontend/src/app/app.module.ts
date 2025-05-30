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
@NgModule({
  declarations: [

    AppComponent,
    BienvenidaComponent,
    HotelesComponent,
    NoencontradoComponent,
    CochesComponent,
    DetallecocheComponent,
    DetallehotelComponent,
    
  ],
  imports: [
    NgxSliderModule,
    ReactiveFormsModule,
    BrowserModule,
    AppRoutingModule,
    HttpClientModule ,
    FormsModule    
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
