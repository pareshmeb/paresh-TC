export interface IReport {
    employeeId: number;
    employeeName: string;
    position: string;
    currentWeekSales: number;
    lastWeekSales: number;
    change: number;
}

export class Report implements IReport {
    employeeId: number;
    employeeName: string;
    position: string;
    currentWeekSales: number;
    lastWeekSales: number;
    change: number;

    /**
     * loading api data to the object properties
     * @param apiItem item from API response
     */
    mapAPIData(apiItem: any): void {
        if (apiItem) {
            if (apiItem['employeeId']) {
                this.setEmployeeId(apiItem['employeeId']);
            }
            if (apiItem['employeeName']) {
                this.setEmployeeName(apiItem['employeeName']);
            }
            if (apiItem['position']) {
                this.setPosition(apiItem['position']);
            }
            if (apiItem['currentWeekSales'] !== undefined) {
                this.setCurrentWeekSales(apiItem['currentWeekSales']);
            }
            if (apiItem['lastWeekSales'] !== undefined) {
                this.setLastWeekSales(apiItem['lastWeekSales']);
            }
            if (apiItem['change'] !== undefined) {
                this.setChange(apiItem['change']);
            }
        }
    }
    /**
     * mapping api data array and creating objects
     * @param apiItems 
     */
    static mapAPIResponse(apiItems: any): Report {
        let mappedData: Report;
        if (apiItems && Array.isArray(apiItems)) {
            apiItems.forEach((apiItem: any)=>{
                const report: Report = new Report();
                report.mapAPIData(apiItem);
                mappedData = report;
            });
        }
        return mappedData;
    }
    //Getters and setters
    getEmployeeId(): number {
        return this.employeeId;
    }
    setEmployeeId(employeeId: number) {
        this.employeeId = employeeId;
    }

    getEmployeeName(): string {
        return this.employeeName;
    }
    setEmployeeName(employeeName: string) {
        this.employeeName = employeeName;
    }

    getPosition(): string {
        return this.position;
    }
    setPosition(position: string) {
        this.position = position
    }

    getCurrentWeekSales(): number {
        return this.currentWeekSales;
    }
    setCurrentWeekSales(currentWeekSales: number) {
        this.currentWeekSales = currentWeekSales;
    }

    getLastWeekSales() : number {
        return this.lastWeekSales;
    }
    setLastWeekSales(lastWeekSales: number) {
        this.lastWeekSales = lastWeekSales;
    }

    getChange(): number {
        return this.change;
    }
    setChange(change: number) {
        this.change = change;
    }
}