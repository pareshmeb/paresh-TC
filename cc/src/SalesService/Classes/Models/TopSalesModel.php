<?php
declare(strict_types=1);
namespace Sales\Models;

use Psr\Container\ContainerInterface;

/**
 * This class is the main model for top sales
 *  API Post Json Data as below   
    {
        "employeeId": "10",
	"employeeName": "Jigar Mehata",
	"position": "Senior Business Development manager",,
	"points": "3980"
    }
     
 */
class TopSalesModel {
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
     * this constant used for setting top no of sales records
     */
    const NO_OF_RECORDS = 10;

    /**
     * @param array $argc
     */
    public function __construct(array $args, ContainerInterface $container) {
        $this->db = $container->get('salesDatabase');
        $this->args = $args;
    }
    /**
     * Get report of employee id
     * @param integer|null $employeeID
     * @return Array from ORM
     */
    private function getTopSalesData(): array {
            $query = "
                WITH product_cost AS (
                        SELECT 
                                product_id, 
                                measurement_type_id, 
                                cost_price
                        FROM 
                                product_cost_price
                ), 
                gross_profit_measures AS (
                        SELECT 
                                gross_profit_amount
                        FROM 
                                sales_point
                        LIMIT 
                                1
                     )
                SELECT 
                        e.employee_id,
                        e.employee_name, 
                        p.position_name,
                        ((sum(qty * sales_amount) - sum(qty * (select cost_price from product_cost WHERE product_id = product_id and measurement_type_id = measurement_type_id limit 1))) 
                          / 
                        (select gross_profit_amount from gross_profit_measures)) AS points
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
                GROUP BY 
                        e.employee_id, 
                        p.position_name
                ORDER BY 
                        points DESC
                LIMIT 
                " . static::NO_OF_RECORDS;
            return $this->db->getAll($query);
    }
    
    /**
     * @return Array from ORM
     */
    public function loadAllData() {
        $employeeSales = $this->getTopSalesData();
        return $this->formatResponseData($employeeSales);
    }
    
    
    /**
     * Formating top sales response details
     * @param array
     * @return \stdClass | Array
     */
    private function formatResponseData(array $employeeSales) {
        $returnData = [];
        foreach ($employeeSales as $employeeSale) {
            $employeeData = new \stdClass();
            $employeeData->employeeId = $employeeSale['employee_id'];
            $employeeData->employeeName = $employeeSale['employee_name'];
            $employeeData->position = $employeeSale['position_name'];
            $employeeData->points = $employeeSale['points'];
            $returnData[] = $employeeData;
        }
        return $returnData;
    }

}
