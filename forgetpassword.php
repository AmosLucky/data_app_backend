<?php

if(isset($_GET['phone'])){

	$response = array('response' => "success" ,"title" => "success", "msg" => "check your email for password");
	echo json_encode($response);
}


?>