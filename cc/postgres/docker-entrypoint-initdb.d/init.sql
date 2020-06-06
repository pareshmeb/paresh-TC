CREATE TABLE "position" (
    position_id SERIAL PRIMARY KEY,
    position_name text NOT NULL
);

CREATE TABLE "employee" (
    employee_id SERIAL PRIMARY KEY,
    employee_name text NOT NULL,
    position_id INTEGER NOT NULL REFERENCES position(position_id)  ON DELETE RESTRICT
);

CREATE TABLE "measurement_type" (
    measurement_type_id SERIAL PRIMARY KEY,
    measurement_type text NOT NULL
);

CREATE TABLE "lead" (
    lead_id SERIAL PRIMARY KEY,
    qty float(2) NOT NULL,
    site_address text NOT NULL,
    contact_name text
);

CREATE TABLE "product" (
    product_id SERIAL PRIMARY KEY,
    product_name text NOT NULL
);

CREATE TABLE "product_cost_price" (
    product_id INTEGER NOT NULL REFERENCES product(product_id)  ON DELETE RESTRICT,
    measurement_type_id INTEGER NOT NULL REFERENCES measurement_type(measurement_type_id)  ON DELETE RESTRICT,
    cost_price NUMERIC NOT NULL,
    PRIMARY KEY(product_id, measurement_type_id)
);

CREATE TABLE "sales_point" (
    gross_profit_amount NUMERIC NOT NULL
);

CREATE TABLE "sales" (
    sales_id SERIAL  PRIMARY KEY,
    employee_id INTEGER NOT NULL REFERENCES employee(employee_id) ON DELETE RESTRICT,
    lead_id INTEGER NOT NULL REFERENCES lead(lead_id) ON DELETE RESTRICT,
    product_id INTEGER NOT NULL REFERENCES product(product_id) ON DELETE RESTRICT,
    measurement_type_id INTEGER NOT NULL REFERENCES measurement_type(measurement_type_id)  ON DELETE RESTRICT,
    qty float(2) NOT NULL,
    sales_amount NUMERIC NOT NULL,
    sales_date date  NOT NULL
);

-- Inserting dummy data
INSERT INTO "position" (position_name) values('Sales Representive');
INSERT INTO "position" (position_name) values('Business Development manager');
INSERT INTO "position" (position_name) values('Senior Business Development manager');

INSERT INTO "employee" (employee_name, position_id) values('Paresh Patel', 1);
INSERT INTO "employee" (employee_name, position_id) values('Raresh Patel', 2);
INSERT INTO "employee" (employee_name, position_id) values('Archana Jadhav', 3);
INSERT INTO "employee" (employee_name, position_id) values('Peter Lee', 1);
INSERT INTO "employee" (employee_name, position_id) values('Sam Pitroda', 1);
INSERT INTO "employee" (employee_name, position_id) values('Jess Raval', 1);
INSERT INTO "employee" (employee_name, position_id) values('Sunil Chaudhary', 2);
INSERT INTO "employee" (employee_name, position_id) values('Vishal Chaudhary', 2);
INSERT INTO "employee" (employee_name, position_id) values('Mahesh Patel', 3);
INSERT INTO "employee" (employee_name, position_id) values('Jigar Mehata', 3);
INSERT INTO "employee" (employee_name, position_id) values('Jiten Machawana', 2);
INSERT INTO "employee" (employee_name, position_id) values('Riddhy Machawana', 1);

INSERT INTO "measurement_type" (measurement_type) values('Metres (Lineal)');
INSERT INTO "measurement_type" (measurement_type) values('Metres (Square)');

INSERT INTO "lead" (qty, site_address, contact_name) values(100, '3 yale circuit, Forest lake', 'Jess');
INSERT INTO "lead" (qty, site_address, contact_name) values(200, '4 tin street, Forest lake', 'Jess1');
INSERT INTO "lead" (qty, site_address, contact_name) values(30, '5 ghtt street, Forest lake', 'Jess2');
INSERT INTO "lead" (qty, site_address, contact_name) values(40, '6 yale circuit, Forest lake', 'Jess3');
INSERT INTO "lead" (qty, site_address, contact_name) values(600, '7 sdfjl street, Forest lake', 'Jess4');
INSERT INTO "lead" (qty, site_address, contact_name) values(900, '8 ramesh street, Forest lake', 'Jess5');
INSERT INTO "lead" (qty, site_address, contact_name) values(450, '9 yale circuit, Forest lake', 'Jess6');
INSERT INTO "lead" (qty, site_address, contact_name) values(235, '0 yale circuit, Forest lake', 'Jess7');
INSERT INTO "lead" (qty, site_address, contact_name) values(124, '53 yale circuit, Forest lake', 'Jess8');
INSERT INTO "lead" (qty, site_address, contact_name) values(252, '43 yale circuit, Forest lake', 'Jess9');
INSERT INTO "lead" (qty, site_address, contact_name) values(452, '33 yale circuit, Forest lake', 'Jess11');
INSERT INTO "lead" (qty, site_address, contact_name) values(326, '63 yale circuit, Forest lake', 'Jess12');
INSERT INTO "lead" (qty, site_address, contact_name) values(126, '43 yale circuit, Forest lake', 'Jess13');
INSERT INTO "lead" (qty, site_address, contact_name) values(326, '83 yale circuit, Forest lake', 'Jess14');
INSERT INTO "lead" (qty, site_address, contact_name) values(115, '93 yale circuit, Forest lake', 'Jess15');
INSERT INTO "lead" (qty, site_address, contact_name) values(154, '53 yale circuit, Forest lake', 'Jess16');
INSERT INTO "lead" (qty, site_address, contact_name) values(214, '63 yale circuit, Forest lake', 'Jess17');
INSERT INTO "lead" (qty, site_address, contact_name) values(658, '83 yale circuit, Forest lake', 'Jess4');
INSERT INTO "lead" (qty, site_address, contact_name) values(456, '93 yale circuit, Forest lake', 'Jess4');

INSERT INTO "product" (product_name) values('Carpet');
INSERT INTO "product" (product_name) values('Wooden floor');

INSERT INTO "product_cost_price" (product_id, measurement_type_id, cost_price) values(1, 1, 100);
INSERT INTO "product_cost_price" (product_id, measurement_type_id, cost_price) values(1, 2, 110);
INSERT INTO "product_cost_price" (product_id, measurement_type_id, cost_price) values(2, 1, 210);
INSERT INTO "product_cost_price" (product_id, measurement_type_id, cost_price) values(2, 2, 150);

INSERT INTO "sales_point" (gross_profit_amount) values(50);

INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(1, 1, 1, 1, 150, 150, '2020-06-08');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(1, 2, 1, 2, 250, 220, '2020-06-03');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(2, 3, 2, 1, 100, 250, '2020-06-08');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(2, 4, 2, 1, 110, 250, '2020-06-04');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(2, 5, 2, 2, 700, 250, '2020-06-03');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(3, 6, 2, 2, 900, 250, '2020-06-03');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(3, 7, 1, 1, 500, 150, '2020-06-08');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(4, 8, 1, 1, 300, 160, '2020-06-03');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(5, 9, 1, 1, 130, 120, '2020-06-08');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(6, 10, 1, 2, 300, 150, '2020-06-03');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(7, 11, 2, 1, 760, 250, '2020-06-08');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(8, 12, 2, 1, 400, 250, '2020-06-03');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(9, 13, 1, 1, 200, 250, '2020-06-03');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(10, 14, 1, 1, 1100, 150, '2020-06-03');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(11, 15, 1, 1, 140, 120, '2020-06-03');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(12, 16, 2, 2, 200, 250, '2020-06-03');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(10, 17, 2, 2, 900, 260, '2020-06-08');
INSERT INTO "sales" (employee_id, lead_id, product_id, measurement_type_id, qty, sales_amount, sales_date) values(11, 18, 2, 1, 550, 250, '2020-06-08');