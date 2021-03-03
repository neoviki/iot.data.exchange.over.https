<?php
session_start();
require_once "./db_helper.php";

function update_db_table($vehicle_id, $time_sent,$gps_lat, $gps_lon, $speed)
{
        $ret = 0;
        global $conn;
        $sql_query = "insert into vehicle_route_record  (vehicle_id, time_sent, gps_lat, gps_lon, speed) values(?,?,?,?,?)";

        if($stmt = mysqli_prepare($conn, $sql_query)){
                mysqli_stmt_bind_param($stmt, "ssddd", $vehicle_id, $time_sent,$gps_lat, $gps_lon, $speed);
                if(mysqli_stmt_execute($stmt)){
                        error_log("db success");
                        $ret = 1; //success
                } else{
                        error_log("db failure");
                        $ret = 0; //failure
                }

                mysqli_stmt_close($stmt);
        }
        return $ret;
}

if (isset($_POST["api_db_push"]) && $_POST["api_db_push"] != ""){
	if(isset($_SESSION['login_success']) && $_SESSION['login_success'] == true){
	    error_log("login success");
        
		$gps_lat = $_POST['gps_lat'];
		$gps_lon = $_POST['gps_lon'];
		$time_sent = $_POST['time_sent'];
		$vehicle_id = $_POST['vehicle_id'];
		$speed = $_POST['speed'];

		$ret = update_db_table($vehicle_id, $time_sent,$gps_lat, $gps_lon, $speed);
		if($ret == 1){
			http_response_code(200);
		}else {
			http_response_code(401); //Unauthorized
		}

	}else{
	    error_log("login failed");
		$message = "Invalid Username or Password";
		echo "<script type='text/javascript'>alert('$message');</script>";
		http_response_code(401); //Unauthorized
	}
}else{
	http_response_code(401); //Unauthorized
}

?>

