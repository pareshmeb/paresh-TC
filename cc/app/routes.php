<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sales\Controllers\TopSalesController;
use Sales\Controllers\EmployeeReportsController;
use Sales\Controllers\EmployeeSalesController;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();    
    
    // Top Sales   
    $app->get('/topsales', function(Request $request, Response $response, array $args) use ($container) {
        return (new TopSalesController($request, $response, $args, $container))
            ->getTopSales();
    });
    // Employee reports for a employee
    $app->get('/employeeReports/{empID}', function(Request $request, Response $response, array $args) use ($container) {
        return (new EmployeeReportsController($request, $response, $args, $container))
            ->getEmployeeReports();
    });
    // Employee weekly sales reports for a employee
    $app->get('/employeeSales/{empID}', function(Request $request, Response $response, array $args) use ($container) {
        return (new EmployeeSalesController($request, $response, $args, $container))
            ->getEmployeeReports();
    });
    
};
