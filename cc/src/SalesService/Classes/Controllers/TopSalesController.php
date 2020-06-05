<?php
declare(strict_types=1);
namespace Sales\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sales\Models\TopSalesModel;
/**
 * This class is handles the sales requests
 **/

class TopSalesController {

    /**
     * @var object
     */
    private $container;
    /**
     * Order model
     * @var object
     */
    private $model;
    /**
     * Handling response
     * @var object
     */
    private $response;
    /**
     * Handling requests
     * @var object
     */
    private $request;
    /**
     * URL Post arguments
     * @var string
     */
    private $args;
    /**
     * Format the data
     * @var object
     */
    private $FormatUtil;

    //This constructor passes the objects required for handling API data and response
    public function __construct(Request $request, Response $response, $args, ContainerInterface $container) {
        $this->request = $request;
        $this->response = $response;
        $this->container = $container;
        $this->FormatUtil = $this->container->get('formatUtil');
        $this->args = $args;
        $this->model = new TopSalesModel($args, $container);
    }

    /**
     * Return Top sales details
     * @return Json
     */
    public function getTopSales(): object {
        return $this->FormatUtil->withJson($this->response, $this->model->loadAllData());
    }

}
