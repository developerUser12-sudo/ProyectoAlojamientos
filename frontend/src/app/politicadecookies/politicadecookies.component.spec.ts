import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PoliticadecookiesComponent } from './politicadecookies.component';

describe('PoliticadecookiesComponent', () => {
  let component: PoliticadecookiesComponent;
  let fixture: ComponentFixture<PoliticadecookiesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PoliticadecookiesComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PoliticadecookiesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
