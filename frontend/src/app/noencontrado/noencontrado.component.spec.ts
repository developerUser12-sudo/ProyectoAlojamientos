import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NoencontradoComponent } from './noencontrado.component';

describe('NoencontradoComponent', () => {
  let component: NoencontradoComponent;
  let fixture: ComponentFixture<NoencontradoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [NoencontradoComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(NoencontradoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
