import { Injectable } from '@angular/core';
import { APIService, IAPIResponse } from './api.service';
import { TopSales } from '../models/top-sales.model';

@Injectable({
  providedIn: 'root'
})
export class TopSalesService {

  constructor(
    private api: APIService
  ) { 

  }

  getTopSales(): Promise<Array<TopSales>> {
    return this.api.get('topsales').then((response: IAPIResponse)=>{
      return TopSales.mapAPIResponse(response.data);
    }).catch((e)=>{
      alert('oops something wrong');
      return Promise.resolve([]);
    });
  }
}
