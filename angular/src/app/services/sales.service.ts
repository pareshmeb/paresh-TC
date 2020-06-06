import { Injectable } from '@angular/core';
import { APIService, IAPIResponse } from './api.service';
import { Sales } from '../models/sales.model';

@Injectable({
  providedIn: 'root'
})
export class SalesService {

  constructor(
    private api: APIService
  ) { 

  }
  /**
   * Get sales records for a particular employee
   * @param employeeId 
   */
  getSalesRecords(employeeId: number): Promise<Array<Sales>> {
    return this.api.get(`employeeSales/${employeeId}`).then((response: IAPIResponse)=>{
      return Sales.mapAPIResponse(response.data);
    }).catch((e)=>{
      alert('oops something wrong');
      return Promise.resolve(null);
    });
  }
}
