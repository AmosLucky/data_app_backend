<?php
include "conn.php";
//if(isset($_GET['login'])){
	$phone = $_GET['phone'];
	$password = $_GET['password'];
	$sql = "SELECT * FROM users where phone = '$phone' && password = '$password'";
	$result = mysqli_query($con,$sql) or die("Cant login ".mysqli_error($con));
	//$response[];
	$num_row = mysqli_num_rows($result);

	if($num_row == 1){
		while ($row = mysqli_fetch_array($result)) {
			$suspended = $row['suspended'];
			# code...
		}
		if($suspended == true){
			$response = array('response'=>'suspended',"msg"=> "Account has been suspened", "title" =>"oops");

		}else{
			$response = array('response'=>'success');
		}
		

	}else{
		$response = array('response'=>'failed',"msg"=> "Incorrect username or password", "title" =>"oops");

		
	}
	echo json_encode($response);
//}



?>