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
class EmployeeReportsModel {
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
                WITH last_week_sales AS (
                        SELECT 
                                employee_id, 
                                sum(qty * sales_amount) AS last_week_sales_amount
                        FROM 
                                sales
                        WHERE 
                                sales_date 
                        BETWEEN
                                NOW()::DATE-EXTRACT(DOW FROM NOW())::INTEGER-7
                        AND 
                                NOW()::DATE-EXTRACT(DOW from NOW())::INTEGER-1
                GROUP BY
                        employee_id
                )
                SELECT 
                        e.employee_name, 
                        p.position_name,
                        sum(s.qty * s.sales_amount) AS current_week_sales,
                        (SELECT last_week_sales_amount FROM last_week_sales WHERE employee_id = employee_id) AS last_week_sales_amount
                FROM 
                        sales s
                JOIN
                        employee e
                USING 
                        (employee_id)
                JOIN
                        position p
                USING
                        (position_id)
                WHERE 
                        s.employee_id = {$employeeID}
                AND
                        sales_date 
                BETWEEN
                        NOW()::DATE-EXTRACT(DOW FROM NOW())::INTEGER
                AND 
                        NOW()::DATE-EXTRACT(DOW from NOW())::INTEGER+6
                GROUP BY 
                        e.employee_id, 
                        p.position_name
                ORDER BY 
                        current_week_sales DESC";
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
            if (isset($employeeSale['last_week_sales_amount'])) {
                $lastWeekSales = $employeeSale['last_week_sales_amount'];
            } else {
                $lastWeekSales = 0;
            }
            if (isset($employeeSale['current_week_sales'])) {
                $currentWeekSales = $employeeSale['current_week_sales'];
            } else {
                $currentWeekSales = 0;
            }
            $employeeData->employeeName = $employeeSale['employee_name'];
            $employeeData->position = $employeeSale['position_name'];
            $employeeData->currentWeekSales = $currentWeekSales;
            $employeeData->lastWeekSales = $lastWeekSales;
            $employeeData->change = $currentWeekSales - $lastWeekSales;
            $returnData[] = $employeeData;
        }
        return $returnData;
    }

}
