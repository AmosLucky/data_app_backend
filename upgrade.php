<?php
include("conn.php");
if(isset($_GET['upgrade'])){
	$phone = $_GET['phone'];
	$password = $_GET['password'];
	$transaction_type = "upgrade";
		$transaction_date = date("d M");
		$ref = "upgrade";
		$success = "success";
		 $amount = 1000;

	$sql = "SELECT * FROM users WHERE phone ='$phone' && password = '$password'";
	$result = mysqli_query($con,$sql) or die("Cant Select ".mysqli_error($con));
	
 while ($row = mysqli_fetch_array($result)){
 	
     $email = $row['email'];
     $referer = $row['referer'];
     $date = $row['registration_date'];
     $num_of_referals = $row['num_of_referrals'];
     $balance = $row['balance'];
       $id = $row['id'];
       $level = $row['level'];

 	
 }


 if($level == "reseller"){
 	 $response = array('response'=>'reseller');
		echo json_encode($response);
		return;

 }


 if($balance >= 1000 ){
 		$new_balance = $balance - 1000;

		$sql = "UPDATE users SET balance = '$new_balance', level = 'reseller' WHERE id = '$id'";
		$result = mysqli_query($con,$sql) or die("Cant update ".mysqli_error($con));
		if($result){
			
			$sql = "INSERT INTO transaction (
			user_id,
			phone_number,
			
			amount,
			transaction_type,
			purchase_date,
			reference,
			status,
			main_date,
			
			old_balance,
			new_balance
			
		) VALUES(
		'$id',
		'$phone',
		'$amount',
		'$transaction_type',
		'$transaction_date',
		'$ref',
		'$success',
		'now()',
		
		'$balance',
		'$new_balance'
		
		)";
		$result = mysqli_query($con,$sql) or die("Cant insert1 ".mysqli_error($con));
		if($result){

		
			 $response = array('response'=>'success');
		echo json_encode($response);
		

		}
		}else{
			 $response = array('response'=>'failed');
		echo json_encode($response);

		}

 }else{
 	$response = array("response"=>"insuficient_balance");
 echo json_encode($response);
 }
 


}else{
 	$response = array("response"=>"failed");
 echo json_encode($response);
 }
 


?>