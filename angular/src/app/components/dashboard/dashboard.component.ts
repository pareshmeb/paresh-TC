import { Component, OnInit } from '@angular/core';
import { TopSales } from 'src/app/models/top-sales.model';
import { TopSalesService } from 'src/app/services/top-sales.service';
import { ReportService } from 'src/app/services/report.service';
import { Report } from 'src/app/models/report.model';
import { Router } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {
  // Holds top 10 sales records
  public topSales: Array<TopSales> = [];
  // Holds comparision report details
  public reportDetails: Report;
  // Used for displaying under proccessing message
  isDataLoaded: boolean = false;
  isLoadingReport: boolean = false;
  refreshDate: string;

  constructor(
    private topSalesService: TopSalesService,
    private reportService: ReportService,
    private router: Router
  ) { 

  }

  async ngOnInit(): Promise<void> {
    // Loads data initially
    this.reloadData();
  }
  // Loading top 10 records through API
  async reloadData() {
    this.isDataLoaded = false;
    this.reportDetails = null;
    this.topSales = await this.topSalesService.getTopSales();
    this.refreshDate = new Date().toString().substr(0,24);
    this.isDataLoaded = true;
  }

  nextComponent() {
    this.router.navigateByUrl('/componenets/sales');
  }

  /**
   * getting comparision report through API
   * @param employeeId 
   */
  async getReport(employeeId: number) {
    this.isLoadingReport = true;
    this.reportDetails = await this.reportService.getReport(employeeId);
    this.isLoadingReport = false;
  }

}
