<?php
declare(strict_types=1);
namespace Sales\Models;

use Psr\Container\ContainerInterface;

/**
 * This class is the main model for Employee Record
 *  API Post Json Data as below   
    {
	"employeeName": "Jigar Mehata",
        "position": "Senior Business Development manager",
        "currentWeekSales": "165000",
        "lastWeekSales": 0,
        "change": 165000
    }
     
 */
class EmployeeSalesModel {
    /**
     * Post request parameters
     * @var array
     */
    private $args;
    /**
     * Database connection object
     * @var object
     */
    private $db;

    /**
     * @param array $args
     */
    public function __construct(array $args, ContainerInterface $container) {
        $this->db = $container->get('salesDatabase');
        $this->args = $args;
    }
    /**
     * Get report details using employeeID
     * @param integer|null $employeeID
     * @return Array from ORM
     */
    private function getEmployeeReportData(int $employeeID = null): array {
        if (!isset($employeeID)) {
            $employeeID = $this->args['empID'];
        }
        if (is_numeric($employeeID)) {
            $query = "
                SELECT  
                        prod.product_name,
                        sales_date,
                        mt.measurement_type,
                        qty, 
                        sales_amount, 
                        qty*sales_amount as total_sales,
                        pcp.cost_price * qty as cost_price
                FROM 
                        public.sales
                JOIN
                        employee e
                USING 
                        (employee_id)
                JOIN
                        position p
                USING
                        (position_id)
                JOIN
                        product prod
                USING
                        (product_id)
                JOIN
                        measurement_type mt
                USING
                        (measurement_type_id)
                JOIN
                        product_cost_price pcp
                USING
                        (product_id, measurement_type_id)
                WHERE 
                        employee_id = {$employeeID}";
            return $this->db->getAll($query);
        } else {
            return [];
        }
    }
    
    /**
     * @return Array from ORM
     */
    public function getEmployeeReports() {
        $employeeSales = $this->getEmployeeReportData();
        return $this->formatResponseData($employeeSales);
    }
    
    
    /**
     * Formating employee report details
     * @param object array
     * @return \stdClass | Array
     */
    private function formatResponseData(array $employeeSales) {
        $returnData = [];
        foreach ($employeeSales as $employeeSale) {
            $employeeData = new \stdClass();
            $date = new \DateTime($employeeSale['sales_date']);
            $employeeData->productName = $employeeSale['product_name'];
            $employeeData->date = $date->format('d/m/Y');
            $employeeData->measurement_type = $employeeSale['measurement_type'];
            $employeeData->qty = $employeeSale['qty'];
            $employeeData->salesPrice = $employeeSale['sales_amount'];
            $employeeData->totalSales = $employeeSale['total_sales'];
            $employeeData->costPrice = $employeeSale['cost_price'];
            $employeeData->grossProfit = $employeeData->totalSales - $employeeData->costPrice;
            $returnData[] = $employeeData;
        }
        return $returnData;
    }

}
