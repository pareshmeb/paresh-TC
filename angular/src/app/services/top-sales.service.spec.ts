import { TestBed } from '@angular/core/testing';

import { TopSalesService } from './top-sales.service';

describe('TopSalesService', () => {
  let service: TopSalesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(TopSalesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
