<?php
include 'conn.php';
if(isset($_GET['password'])){
	$phone = $_GET['phone'];
	$password = $_GET['password'];
	$new_password = $_GET['new_password'];
	$sql = "UPDATE  users set password =  '$new_password' where phone = '$phone' && password = '$password'";
	$result = mysqli_query($con,$sql) or die("Cant login ".mysqli_error($con));
	if($result){
		$response = array('response'=>'success');
	}else{
		$response = array('response'=>'failed');
	}
	echo json_encode($response);

}



?>