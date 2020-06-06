import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { SalesService } from 'src/app/services/sales.service';
import { Sales } from 'src/app/models/sales.model';

@Component({
  selector: 'app-sales',
  templateUrl: './sales.component.html',
  styleUrls: ['./sales.component.scss']
})
export class SalesComponent implements OnInit {
  isDataLoaded: boolean = false;
  employeeName: string;
  public salesRecords: Array<Sales> = [];

  constructor(
    private route: ActivatedRoute,
    private salesService: SalesService
  ) {
    
   }

  ngOnInit(): void {
    let id = this.route.snapshot.queryParams.id;
    this.employeeName = this.route.snapshot.queryParams.name;
    this.loadData(id);
  }

  // Load Saled records
  async loadData(employeeId: number) {
    this.isDataLoaded = false;
    this.salesRecords = await this.salesService.getSalesRecords(employeeId);
    this.isDataLoaded = true;
  }

}
