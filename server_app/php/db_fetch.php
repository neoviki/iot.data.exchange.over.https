<?php
session_start();
require_once "./db_helper.php";

function get_latest_db_entry($vehicle_id, $result_count)
{
        global $conn;
        $query = 'select * from vehicle_route_record  where vehicle_id="'.$vehicle_id.'" ORDER BY time_sent DESC LIMIT '.$result_count.'';
        $result = mysqli_query($conn, $query);
	$data = array();
	$i=0;
        if(mysqli_num_rows($result) > 0 ){
                while( $row = mysqli_fetch_array($result) ){
		   $data[$i] = array(
				'vehicle_id' => $vehicle_id, 
				'speed' => $row["speed"], 
				'gps_lat' => $row["gps_lat"], 
				"gps_lon" => $row["gps_lon"]
				);
		   $i = $i + 1;
		}
	}

	header('Content-Type: application/json');
	echo json_encode($data);
}


if (isset($_POST["api_db_fetch"]) && $_POST["api_db_fetch"] != ""){
	if(isset($_SESSION['login_success']) && $_SESSION['login_success'] == true){
	    error_log("login success");
		$vehicle_id = $_POST['vehicle_id'];
		$result_count = $_POST['result_count'];
		if($result_count > 100) $result_count = 100; /*Do not fetch morethan 100 items*/
		get_latest_db_entry($vehicle_id, $result_count);
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

