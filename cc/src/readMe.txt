Installation instruction:

1) Please navigate to cc folder into command prompt
2) run docker-compose up
3) All endpoints returns Json Data, use belows url to test:	
	GET - http://0.0.0.0:8080/topsales
	GET - http://0.0.0.0:8080/employeeReports/10
        GET - http://0.0.0.0:8080/employeeSales/10
	
Explanation:
	I have created 1 services(sales). 
        Sales service has it's own database so that they can be easily deployed on the separate server.
	It is using the postgreSQL database, 
        You can find the database structure file in postgres/docker-entrypoint-initdb/init.sql
	
	All codes written by me you will find into below folders
	\cc\SalesService\
	\cc\src\Common
	\cc\app\routes.php
	
	Please let me know if you have questions or need a help to setup.
	
	
