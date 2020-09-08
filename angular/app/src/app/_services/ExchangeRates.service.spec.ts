/* tslint:disable:no-unused-variable */

import { TestBed, async, inject } from '@angular/core/testing';
import { ExchangeRatesService } from './ExchangeRates.service';

describe('Service: ExchangeRates', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [ExchangeRatesService]
    });
  });

  it('should ...', inject([ExchangeRatesService], (service: ExchangeRatesService) => {
    expect(service).toBeTruthy();
  }));
});
