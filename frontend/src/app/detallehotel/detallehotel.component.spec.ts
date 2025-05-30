import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetallehotelComponent } from './detallehotel.component';

describe('DetallehotelComponent', () => {
  let component: DetallehotelComponent;
  let fixture: ComponentFixture<DetallehotelComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [DetallehotelComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DetallehotelComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
