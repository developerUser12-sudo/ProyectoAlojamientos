import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetallecocheComponent } from './detallecoche.component';

describe('DetallecocheComponent', () => {
  let component: DetallecocheComponent;
  let fixture: ComponentFixture<DetallecocheComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [DetallecocheComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DetallecocheComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
