## IoT Data Exchange over HTTP/HTTPS

An architecture harnesses vastly deployed HTTP/HTTPS infrastructure for a cost-effective Internet of Things ecosystem.

Architecture Overview:

![IoT over HTTP/HTTPS](images/iot_over_http.png)

#### Server APP:

Server APP has to be deployed on an HTTP server

	-> server_app/php


#### Client API 

Client API can be called from any IoT device.

	-> client_api/python

#### DB Setup

Create a db with the following credentials

	define('DB_SERVER', '127.0.0.1:3306');
	define('DB_USERNAME', 'testdb');
	define('DB_PASSWORD', 'testdb123');
	define('DB_NAME', 'testdb');

Create a db table using the following command

	CREATE TABLE `testdb`.`vehicle_route_record` ( `id` INT NOT NULL AUTO_INCREMENT, `vehicle_id` VARCHAR(32) NULL , `time_received` TIMESTAMP(6) NOT NULL , `time_sent` DATETIME(6) NOT NULL , `gps_lat` DOUBLE , `gps_lon` DOUBLE , `speed` DOUBLE NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;



#### Note:

Currently, the client API is written in Python, and the server application is written in PHP. In the future, support for additional programming languages such as C/C++, JavaScript, and others will be extended.




