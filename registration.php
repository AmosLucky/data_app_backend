<?php
include "conn.php";
if(isset($_GET['register'])){

$first_name = $_GET['first_name'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$password = $_GET['password'];
$level = 'reseller';

	$referal_code = $_GET['referer'];
	if(strlen($referal_code) < 11){
	$referal_code = "08106799951";



}else if($referal_code == $phone){
	$referal_code = "08106799951";

}
////////////// updating  num of referal /////////////////////
$sql = "UPDATE users set num_of_referrals = num_of_referrals + 1 where phone = '$referal_code'";
mysqli_query($con,$sql) or die("Cant registrer ".mysqli_error($con));




$has_deposited = false;
$registration_date = date('D d M Y');
$initial_balance = 0;
$initial_referrals = "0";
$sql = "SELECT * FROM users where phone = '$phone'";
$result = mysqli_query($con,$sql) or die("Cant registrer ".mysqli_error($con));
$num_of_row = mysqli_num_rows($result);
if($num_of_row > 0){
	$response = array("response"=>"user_already_exist");
			echo json_encode($response);
			return;

}


$sql = "INSERT into users (
				first_name,
				phone,
				email,
				password,
				balance,
				referer, 
				level,
				num_of_referrals,
				registration_date,
				main_date,
				has_deposited
				) 
				values(
				'$first_name',
				'$phone',
				'$email',
				
				'$password',
				'$initial_balance',
				'$referal_code',
				'$level',
				'$initial_referrals',
				'$registration_date',
				now(),
				'Shas_deposited'


				)
				";

	$result = mysqli_query($con,$sql) or die("Cant registrer ".mysqlI_error($con));

	if($result){
		$response = array("response"=>"success");
		echo json_encode($response);
	}else{
			$response = array("response"=>"failed");
			echo json_encode($response);
	}




}




?>