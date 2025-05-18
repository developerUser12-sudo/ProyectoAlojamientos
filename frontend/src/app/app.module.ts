import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BienvenidaComponent } from './bienvenida/bienvenida.component';
import { VuelosComponent } from './vuelos/vuelos.component';
import { HotelesComponent } from './hoteles/hoteles.component';
import { AlquilercochesComponent } from './alquilercoches/alquilercoches.component';
import { FormsModule } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { NgxSliderModule } from '@angular-slider/ngx-slider';
@NgModule({
  declarations: [

    AppComponent,
    BienvenidaComponent,
    VuelosComponent,
    HotelesComponent,
    AlquilercochesComponent,
    
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
