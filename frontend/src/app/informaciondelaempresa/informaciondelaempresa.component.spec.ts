import { ComponentFixture, TestBed } from '@angular/core/testing';

import { InformaciondelaempresaComponent } from './informaciondelaempresa.component';

describe('InformaciondelaempresaComponent', () => {
  let component: InformaciondelaempresaComponent;
  let fixture: ComponentFixture<InformaciondelaempresaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [InformaciondelaempresaComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(InformaciondelaempresaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
