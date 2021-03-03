<?php
session_start();

if (isset($_POST["api_login"]) && $_POST["api_login"] != ""){
    
	if(($_POST['username'] == "test") && ($_POST['password'] == "test123")){
		$_SESSION['login_success'] = true;
		http_response_code(200);
	}else{
		http_response_code(401);
	}
}else{
     http_response_code(401); 
}

?>

