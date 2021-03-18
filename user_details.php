<?php
include "conn.php";
if(isset($_GET['user_details'])){
	
	$phone = $_GET['phone'];
	$password = $_GET['password'];
	$sql = "SELECT * FROM users WHERE phone = '$phone' && password = '$password'";

	$result = mysqli_query($con,$sql) or die("Cant login ".mysqli_error($con));
	//$response[];
	$num_row = mysqli_num_rows($result);

	if($num_row == 1){
		while ($row = mysqli_fetch_array($result)) {
			$balance = $row['balance'];
			$username = $row['first_name'];
			$id = $row['id'];
			$email = $row['email'];
			$level = $row['level'];

			# code...
		}
		$response = array('response'=>'success','balance'=>$balance,'username'=> $username,'id'=>$id,'email'=>$email,'level'=>$level,);
		echo json_encode($response);
		

	}else{
		$response = array('response'=>'failed');
		echo json_encode($response);
		
	}
	
}


?>