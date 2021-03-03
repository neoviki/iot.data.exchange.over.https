<?php
define('DB_SERVER', '127.0.0.1:3306');
define('DB_USERNAME', 'testdb');
define('DB_PASSWORD', 'testdb123');
define('DB_NAME', 'testdb');


$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    error_log("ERROR: Could not connect. " . mysqli_connect_error());
}

?>
