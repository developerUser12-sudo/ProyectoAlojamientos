import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AlquilercochesComponent } from './alquilercoches.component';

describe('AlquilercochesComponent', () => {
  let component: AlquilercochesComponent;
  let fixture: ComponentFixture<AlquilercochesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [AlquilercochesComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AlquilercochesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
