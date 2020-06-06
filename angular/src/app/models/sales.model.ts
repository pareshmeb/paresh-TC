export interface ISales {
    productName: string;
    date: string;
    measurementType: string;
    qunatity: number;
    salesPrice: number;
    totalSales: number;
    costPrice: number;
    grossProfit: number;
}

export class Sales implements ISales {
    productName: string;
    date: string;
    measurementType: string;
    qunatity: number;
    salesPrice: number;
    totalSales: number;
    costPrice: number;
    grossProfit: number;

    /**
     * loading api data to the object properties
     * @param apiItem item from API response
     */
    mapAPIData(apiItem: any): void {
        if (apiItem) {
            if (apiItem['productName']) {
                this.setProductName(apiItem['productName']);
            }
            if (apiItem['date']) {
                this.setDate(apiItem['date']);
            }
            if (apiItem['measurement_type']) {
                this.setMeasurementType(apiItem['measurement_type']);
            }
            if (apiItem['qty']) {
                this.setQunatity(apiItem['qty']);
            }
            if (apiItem['salesPrice']) {
                this.setSalesPrice(apiItem['salesPrice']);
            }
            if (apiItem['totalSales']) {
                this.setTotalSales(apiItem['totalSales']);
            }
            if (apiItem['costPrice']) {
                this.setCostPrice(apiItem['costPrice']);
            }
            if (apiItem['grossProfit']) {
                this.setGrossProfit(apiItem['grossProfit']);
            }
        }
    }

    /**
     * mapping api data array and creating objects
     * @param apiItems 
     */
    static mapAPIResponse(apiItems: any): Array<Sales> {
        const mappedData: Array<Sales> = [];
        if (apiItems && Array.isArray(apiItems)) {
            apiItems.forEach((apiItem: any)=>{
                const topSales: Sales = new Sales();
                topSales.mapAPIData(apiItem);
                mappedData.push(topSales);
            });
        }
        return mappedData;
    }

    // getters setters
    getProductName(): string {
        return this.productName;
    }
    setProductName(productName: string) {
        this.productName = productName;
    }

    getDate():string {
        return this.date;
    }
    setDate(date:string) {
        return this.date = date;
    }

    getMeasurementType():string {
        return this.measurementType
    }
    setMeasurementType(measurementType :string) {
        this.measurementType = measurementType;
    }

    getQunatity(): number {
        return this.qunatity;
    }
    setQunatity(qunatity: number) {
        this.qunatity = qunatity;
    }

    getSalesPrice(): number {
        return this.salesPrice;
    }
    setSalesPrice(salesPrice: number) {
        this.salesPrice = salesPrice;
    }

    getTotalSales(): number {
        return this.totalSales;
    }
    setTotalSales(totalSales: number) {
        this.totalSales = totalSales;
    }
    getCostPrice(): number {
        return this.costPrice;
    }
    setCostPrice(costPrice: number) {
        this.costPrice = costPrice;
    }
    getGrossProfit(): number {
        return this.grossProfit;
    }
    setGrossProfit(grossProfit: number) {
        this.grossProfit = grossProfit;
    }
}