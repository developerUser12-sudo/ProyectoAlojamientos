import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TerminosdeservicioComponent } from './terminosdeservicio.component';

describe('TerminosdeservicioComponent', () => {
  let component: TerminosdeservicioComponent;
  let fixture: ComponentFixture<TerminosdeservicioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [TerminosdeservicioComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(TerminosdeservicioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
