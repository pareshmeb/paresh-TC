export interface ITopSales {
    employeeId: number;
    employeeName: string;
    points: number;
    position: string;
}

export class TopSales implements ITopSales {
    employeeId: number;
    employeeName: string;
    points: number;
    position: string;

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
            if (apiItem['points'] !== undefined) {
                this.setPoints(apiItem['points']);
            }
            if (apiItem['position']) {
                this.setPosition(apiItem['position']);
            }
        }
    }

    /**
     * mapping api data array and creating objects
     * @param apiItems 
     */
    static mapAPIResponse(apiItems: any): Array<TopSales> {
        const mappedData: Array<TopSales> = [];
        if (apiItems && Array.isArray(apiItems)) {
            apiItems.forEach((apiItem: any)=>{
                const topSales: TopSales = new TopSales();
                topSales.mapAPIData(apiItem);
                mappedData.push(topSales);
            });
        }
        return mappedData;
    }

    // getters setters
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

    getPoints(): number {
        return this.points;
    }
    setPoints(points: number) {
        this.points = points;
    }

    getPosition(): string {
        return this.position;
    }
    setPosition(position: string) {
        this.position = position
    }
}