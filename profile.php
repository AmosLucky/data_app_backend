<?php
include("conn.php");
if(isset($_GET['profile'])){
	$phone = $_GET['phone'];
	$password = $_GET['password'];
	$sql = "SELECT * FROM users WHERE phone ='$phone' && password = '$password'";
	$result = mysqli_query($con,$sql) or die("Cant Select ".mysqli_error($con));
	
 while ($row = mysqli_fetch_array($result)){
 	
     $email = $row['email'];
     $referer = $row['referer'];
     $date = $row['registration_date'];
     $num_of_referals = $row['num_of_referrals'];
 	
 }
 $response = array("email"=>$email,"referer"=>$referer,'date'=>$date,"num_of_referals"=>$num_of_referals);
 echo json_encode($response);


}


?>