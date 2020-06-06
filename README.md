Installation instruction:

1) Please clone my repo https://github.com/pareshmeb/paresh-TC
3) Please navigate to cc folder using a terminal
4) run - composer install
5) run - docker-compose up
6) All endpoints returns Json Data. use belows url to test:
    GET - http://0.0.0.0:8080/topsales
    GET - http://0.0.0.0:8080/employeeReports/10
    GET - http://0.0.0.0:8080/employeeSales/10
7) Please navigate to angular folder
8) do npm install
9) ng serve --open
	
10) Explanation:
    I have created 1 service(sales). 
    Sales service has it's own database so that they can be easily deployed on the separate server.
    It is using the postgreSQL database.
    It is using slim framework for rest API.
    You can find the database structure file in postgres/docker-entrypoint-initdb/init.sql.
	
    All codes written by me you will find into below folders.
        \cc\SalesService\
	\cc\src\Common
	\cc\app\routes.php
        \angular
        \results
	
    Please let me know if you have questions or need a help to setup.
	
	
