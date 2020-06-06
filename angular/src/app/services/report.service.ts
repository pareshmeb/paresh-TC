import { Injectable } from '@angular/core';
import { IAPIResponse, APIService } from './api.service';
import { Report } from '../models/report.model';

@Injectable({
  providedIn: 'root'
})
export class ReportService {

  constructor(
    private api: APIService
  ) { }

  /**
   * Get comparison report for the particular employee
   * @param employeeId 
   */
  getReport(employeeId: number): Promise<Report> {
    return this.api.get(`employeeReports/${employeeId}`).then((response: IAPIResponse)=>{
      return Report.mapAPIResponse(response.data);
    }).catch((e)=>{
      alert('oops something wrong');
      return Promise.resolve(null);
    });
  }

}
