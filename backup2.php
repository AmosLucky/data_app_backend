
<?php
include 'conn.php';

if(isset($_GET['request'])){
	$users_phone = $_GET['phone'];
	$password = $_GET['password'];
	$network = $_GET['network'];
	$requested_phone = $_GET['requested_phone'];
	$data_plan = $_GET['data_plan'];
	$request_date = date('D d M');
	$level = $_GET['level'];
	$datasize1;
	$datasize2;
 $level;
	
		
$networkCode = 1;
$transaction_type = "Data Topup";
$success = "success";
if($network == "MTN"){
	


	if($level == "reseller"){
	

		//////////////////////////////////////////////////////////////////////////////////////
	if(substr($data_plan, 0,3) == '1GB'){
		$price = 340;
		$datasize1 = 1000;
		$datasize2 = "";

	}else if(substr($data_plan, 0,3) == '2GB'){
		$price = 660;
		$datasize1 = 2000;
		$datasize2 = "";
		
	}else if(substr($data_plan, 0,3) == '3GB'){
		$price = 1000;
		$datasize1 = 2000;
		$datasize2 = 1000;
	}else if(substr($data_plan, 0,3) == '4GB'){
		$price = 1300;
		$datasize1 = 3000;
		$datasize2 =1000;
		
	}else if(substr($data_plan, 0,3) == '5GB'){
		$price = 1600;
		$datasize1 = 5000;
		$datasize2 ="";
		
	}else if(substr($data_plan, 0,3) == '6GB'){
		$price = 2110;
		$datasize1 = 5000;
		$datasize2 = 1000;
		
	}else if(substr($data_plan, 0,3) == '7GB'){
		$price = 2450;
		$datasize1 = 5000;
		$datasize2 =2000;
		
	}else if(substr($data_plan, 0,4) == '10GB'){
		$price = 3200;
		$datasize1 = 5000;
		$datasize2 =5000;
		
	}else if(substr($data_plan, 0,4) == '15GB'){
		$price = 5250;
		$datasize1 = 10000;
		$datasize2 =5000;
		
	}else{
		 $response = array('response'=>'failed');
		echo json_encode($response);
		return;

	}
	//////
	}  else if($level == "basic"){
		
		//////////// level is reseller /////////////////////////////////////////////////
		if(substr($data_plan, 0,3) == '1GB'){
		$price = 390;
		$datasize1 = 1000;
		$datasize2 = "";

	}else if(substr($data_plan, 0,3) == '2GB'){
		$price = 750;
		$datasize1 = 2000;
		$datasize2 = "";
		
	}else if(substr($data_plan, 0,3) == '3GB'){
		$price = 1130;
		$datasize1 = 2000;
		$datasize2 = 1000;
	}else if(substr($data_plan, 0,3) == '4GB'){
		$price = 1450;
		$datasize1 = 1000;
		$datasize2 =3000;
		
	}else if(substr($data_plan, 0,3) == '5GB'){
		$price =1800;
		$datasize1 = 5000;
		$datasize2 ="";
		
	}else if(substr($data_plan, 0,3) == '6GB'){
		$price = 1170;
		$datasize1 = 5000;
		$datasize2 = 1000;
		
	}else if(substr($data_plan, 0,3) == '7GB'){
		$price = 2530;
		$datasize1 = 5000;
		$datasize2 =2000;
		
	}else if(substr($data_plan, 0,4) == '10GB'){
		$price = 3600;
		$datasize1 = 5000;
		$datasize2 =5000;
		
	}else if(substr($data_plan, 0,4) == '15GB'){
		$price = 5450;
		$datasize1 = 10000;
		$datasize2 =5000;
		
	}else{
		 $response = array('response'=>'failed');
		echo json_encode($response);
		return;

	}
	//////
	}else{
		//////// no level//////////////////////////////////////////////////////////////////////////
		 $response = array('response'=>'failed');
		echo json_encode($response);
		return;

	}



	

	


	

	//$password = $_GET['password'];
	$sql = "SELECT * FROM users WHERE phone = '$users_phone' && password = '$password'";

	$result = mysqli_query($con,$sql) or die("Cant login ".mysqli_error($con));
	//$response[];
	$num_row = mysqli_num_rows($result);

	if($num_row == 1){
		while ($row = mysqli_fetch_array($result)) {
			$id = $row['id'];
			$balance = $row['balance'];
			$username = $row['first_name'];

			# code...
		}
		if($balance >= $price){
				$ref = rand(10,1000).date('mdYHis')."&".$id."&".$users_phone."&".$requested_phone;
  	if(
	substr($data_plan, 0,3) == "1GB" ||
	substr($data_plan, 0,3) == "2GB"||
	substr($data_plan, 0,3) == "5GB"
){
  		
  		/////////////////////////////////// single reques //////////////////////
  		
		$request_type = 'single';
		
$json = file_get_contents("https://mobileairtimeng.com/httpapi/datashare?userid=08106799951&pass=c18964f3d8a4c955b66a&network=1&phone=$requested_phone&datasize=$datasize1&user_ref=$ref&jsn=json");

  $response = $obj = json_decode($json,true);
  	 $response_code = $response['code'];
  	 $response_message = $response['message'];
 

  	if($response_code == 100){
  		////////wen it was succssfull /////////////////////////////////////////////////////

  		$new_balance = $balance - $price;
		$sql = "UPDATE users SET balance = '$new_balance' WHERE id = '$id'";
		$result = mysqli_query($con,$sql) or die("Cant update ".mysqli_error($con));
		$transaction_date = date('D d M h:s');
	///$channel = "paystack";
		//// sucess full//////////////////////////////////////////////////////
	 $response = array('response'=>'success');
		 echo json_encode($response);

		 ///////////////// success fulllllllllllllllllllllllllllllll
		if($result){
			////// wen the had been debitted////////////////////////////////////////////////
			$sql = "INSERT INTO transaction (
			user_id,
			phone_number,
			request_phone_number,
			network,
			amount,
			transaction_type,
			purchase_date,
			reference,
			status,
			main_date,
			data_plan,
			data_size,
			
			request_type,
			request_code,
			request_message,
			old_balance,
			new_balance
			
		) VALUES(
		'$id',
		'$users_phone',
		'$requested_phone',
		
		'$network',
		'$price',
		'$transaction_type',
		'$transaction_date',
		'$ref',
		'$success',
		'now()',
		'$data_plan',
		'$datasize1',
		
		'$request_type',
		'$response_code',
		'$response_message',
		'$balance',
		'$new_balance'
		
		)";
		$result = mysqli_query($con,$sql) or die("Cant insert1 ".mysqli_error($con));
		if($result){
			//  $response = array('response'=>'success');
		 // echo json_encode($response);

		}

		}else{

			/////////////////the cant be debited///////////////////////
			 $response = array('response'=>'failed');
	   echo json_encode($response);

		}





  	} else if($response_code == 107){
  		//////////////////////////////////////// invalid phone //////////////
  		 $response = array('response'=>'invalid_phone');
	   echo json_encode($response);
  	}else if($response_code == 106){
  		//////////////////////////////////////// invalid phone //////////////
  		 $response = array('response'=>'wait');
	   echo json_encode($response);
  	}
  	else{

			/////////////////other response from the mobile airtime///////////////////////
			 $response = array('response'=>'failed');
	   echo json_encode($response);

		}



  	}else if(

	substr($data_plan, 0,3) == "3GB" ||
	substr($data_plan, 0,3) == '4GB' ||
	substr($data_plan, 0,3) =='6GB' ||
	substr($data_plan, 0,3) =='7GB' ||
	substr($data_plan, 0,4) =='10GB' ||
	substr($data_plan, 0,4) =='15GB' 



  	){
  		

	$ref = rand(10,1000).date('mdYHis')."&".$id."&".$users_phone."&1".$requested_phone;
  		///////////////////// double request ///////////////////////

  			$request_type = 'double 1';
$json = file_get_contents("https://mobileairtimeng.com/httpapi/datashare?userid=08106799951&pass=c18964f3d8a4c955b66a&network=1&phone=$requested_phone&datasize=$datasize1&user_ref=$ref&jsn=json");
  $response = $obj = json_decode($json,true);
  	$response_code = $response['code'];
  	$response_message = $response['message'];
  
  	//// sucess full//////////////////////////////////////////////////////
	 $response = array('response'=>'success');
		 echo json_encode($response);

		 ///////////////// success fulllllllllllllllllllllllllllllll


  	if($response_code == 100){
  		////////wen it was succssfull /////////////////////////////////////////////////////

  		$new_balance = $balance - $price;
		$sql = "UPDATE users SET balance = '$new_balance' WHERE id = '$id'";
		$result = mysqli_query($con,$sql) or die("Cant update ".mysqli_error($con));
		$transaction_date = date('D d M h:s');
	///$channel = "paystack";
	
		if($result){
			////// wen the had been debitted////////////////////////////////////////////////
			$sql = "INSERT INTO transaction (
			user_id,
			phone_number,
			request_phone_number,
			network,
			amount,
			transaction_type,
			purchase_date,
			reference,
			status,
			main_date,
			data_plan,
			data_size,
			
			request_type,
			request_code,
			request_message,
			old_balance,
			new_balance
			
		) VALUES(
		'$id',
		'$users_phone',
		'$requested_phone',
		
		'$network',
		'$price',
		'$transaction_type',
		'$transaction_date',
		'$ref',
		'$success',
		'now()',
		'$data_plan',
		'$datasize1',
		
		'$request_type',
		'$response_code',
		'$response_message',
		'$balance',
		'$new_balance'
		
		)";
		$result = mysqli_query($con,$sql) or die("Cant insert1 ".mysqli_error($con));
		if($result){
			//  $response = array('response'=>'success');
		 // echo json_encode($response);

		}
	$ref =  rand(10,1000).date('mdYHis')."&".$id."&".$users_phone."&2".$requested_phone."&".rand(10,1000).date('mdYHis');
		////////////////////////// second request //////////////
$request_type = 'double 2';
		$json = file_get_contents("https://mobileairtimeng.com/httpapi/datashare?userid=08106799951&pass=c18964f3d8a4c955b66a&network=1&phone=$requested_phone&datasize=$datasize2&user_ref=$ref&jsn=json");
  $response = $obj = json_decode($json,true);
  	$response_code = $response['code'];
  	$rsponse_message = $response['message'];
  	 

  	 $sql = "INSERT INTO transaction (
			user_id,
			phone_number,
			request_phone_number,
			network,
			amount,
			transaction_type,
			purchase_date,
			reference,
			status,
			main_date,
			data_plan,
			data_size,
			
			request_type,
			request_code,
			request_message
			
		) VALUES(
		'$id',
		'$users_phone',
		'$requested_phone',
		
		'$network',
		'$price',
		'$transaction_type',
		'$transaction_date',
		'$ref',
		'$success',
		'now()',
		'$data_plan',
		'$datasize2',
		
		'$request_type',
		'$response_code',
		'$response_message'
		
		)";
		$result = mysqli_query($con,$sql) or die("Cant insert1 ".mysqli_error($con));
	  





		}else{

			/////////////////the cant be debited///////////////////////
			 $response = array('response'=>'failed');
	   echo json_encode($response);

		}





  	} else if($response_code == 107){
  		//////////////////////////////////////// invalid phone //////////////
  		 $response = array('response'=>'invalid_phone');
	   echo json_encode($response);
  	}else{

			/////////////////other response from the mobile airtime///////////////////////
			 $response = array('response'=>'failed');
	   echo json_encode($response);

		}

  	}

	
		}else{
			////////////////// insuficient balance //////////////
			 $response = array('response'=>'insuficient_balance');
		echo json_encode($response);

		}
		

	}else{
		//////////////// user not found////////
		$response = array('response'=>'failed');
		echo json_encode($response);
		
	}

}

///////////////////////////////////////////////////other network//////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

else{


 if($network == 'Airtel'){
 	
 	$networkCode = 1;
	if(substr($data_plan, 0,5) == '750MB'){
		$price = 500;
		$datasize1 = 500;
		

	}else if(substr($data_plan, 0,5) == '1.5GB'){
		$price = 1000;
		$datasize1 = 1000;
		

	}else if(substr($data_plan, 0,3) == '2GB'){
		$price = 1200;
		$datasize1 = 1200;
		

	}else if(substr($data_plan, 0,3) == '3GB'){
		$price = 1500;
		$datasize1 = 1500;
		

	}else if(substr($data_plan, 0,5) == '4.5GB'){
		$price = 2000;
		$datasize1 = 2000;
		

	}else if(substr($data_plan, 0,3) == '6GB'){
		$price = 2500;
		$datasize1 = 2500;
		

	}else if(substr($data_plan, 0,3) == '8GB'){
		$price = 3000;
		$datasize1 = 3000;
		

	}else{
		//////////////// user not found////////
		$response = array('response'=>'failed');
		echo json_encode($response);
		return;
		
	}
	

}

else if($network == '9mobile'){
	$networkCode = 2;
	
		

if(substr($data_plan, 0,5) == '500GB'){
		$price = 550;
		$datasize1 = 500;
		

	}else if(substr($data_plan, 0,5) == '1.5GB'){
		$price = 1050;
		$datasize1 = 1000;
		

	}else if(substr($data_plan, 0,3) == '2GB'){
		$price = 1250;
		$datasize1 = 1200;
		

	}else if(substr($data_plan, 0,4) == '4.5GB'){
		$price =2050;
		$datasize1 = 2000;
		

	}else if(substr($data_plan, 0,3) == '7GB'){
		$price = 4550;
		$datasize1 = 1500;
		

	}else if(substr($data_plan, 0,4) == '15GB'){
		$price =5050;
		$datasize1 = 5000;
		

	}else{
		//////////////// user not found////////
		$response = array('response'=>'failed');
		echo json_encode($response);
		return;
		
	}
	

}






else if($network == 'Glo'){
	$networkCode = 6;
	
if(substr($data_plan, 0,5) == '920MB'){
		$price = 550;
		$datasize1 = 500;
		

	}else if(substr($data_plan, 0,5) == '1.8GB'){
		$price =1050;
		$datasize1 = 1000;
		

	}else if(substr($data_plan, 0,5) == '4.5GB'){
		$price =2050;
		$datasize1 = 2000;
		

	}else if(substr($data_plan, 0,5) == '7.2GB'){
		$price = 2550;
		$datasize1 = 2500;
		

	}else if(substr($data_plan, 0,6) == '8.75GB'){
		$price = 3050;
		$datasize1 = 3000;
		

	}else if(substr($data_plan, 0,6) == '12.5GB'){
		$price = 4050;
		$datasize1 = 4000;
		

	}else if(substr($data_plan, 0,6) == '15.6GB'){
		$price = 5550;
		$datasize1 = 5000;
		

	}else{
		//////////////// netwk not found////////
		$response = array('response'=>'failed');
		echo json_encode($response);
		return;
		
	}

	
	
	

}else{
		//////////////// netwk not found////////
		$response = array('response'=>'failed');
		echo json_encode($response);
		return;
		
	}









/////////////////////// selecting users///////////////////////

	///////////////////////

	$sql = "SELECT * FROM users WHERE phone = '$users_phone' && password = '$password'";

	$result = mysqli_query($con,$sql) or die("Cant login ".mysqli_error($con));
	//$response[];
	$num_row = mysqli_num_rows($result);

	if($num_row == 1){

		while ($row = mysqli_fetch_array($result)) {
			$id = $row['id'];
			$balance = $row['balance'];
			$username = $row['first_name'];

			# code...
		}
		if($balance >= $price){
		
			$ref = rand(10,1000).date('mdYHis')."&".$id."&".$users_phone."&".$requested_phone;

///////////////////////////////////// REQUESTING ////////////////////////

					/////////////////////////////////// single reques //////////////////////
  		
		$request_type = 'single';
$json = file_get_contents("https://mobileairtimeng.com/httpapi/datatopup.php?userid=08106799951&pass=c18964f3d8a4c955b66a&network=$networkCode&phone=$requested_phone&amt=$datasize1&user_ref=$ref&jsn=json");
  $response = $obj = json_decode($json,true);
   $networkCode;
  	 $response_code = $response['code'];
  	 $response_message = $response['message'];
  	 $requested_phone;
  	$datasize1;
 

  	if($response_code == 100){
  		////////wen it was succssfull /////////////////////////////////////////////////////

  			//// sucess full//////////////////////////////////////////////////////
	 $response = array('response'=>'success');
		 echo json_encode($response);

		 ///////////////// success fulllllllllllllllllllllllllllllll

  		$new_balance = $balance - $price;
		$sql = "UPDATE users SET balance = '$new_balance' WHERE id = '$id'";
		$result = mysqli_query($con,$sql) or die("Cant update ".mysqli_error($con));
		$transaction_date = date('D M h:s');
	///$channel = "paystack";
	
		if($result){
			////// wen the had been debitted////////////////////////////////////////////////
			$sql = "INSERT INTO transaction (
			user_id,
			phone_number,
			request_phone_number,
			network,
			amount,
			transaction_type,
			purchase_date,
			reference,
			status,
			main_date,
			data_plan,
			data_size,
			
			request_type,
			request_code,
			request_message,
			old_balance,
			new_balance
			
		) VALUES(
		'$id',
		'$users_phone',
		'$requested_phone',
		
		'$network',
		'$price',
		'$transaction_type',
		'$transaction_date',
		'$ref',
		'$success',
		'now()',
		'$data_plan',
		'$datasize1',
		
		'$request_type',
		'$response_code',
		'$response_message',
		'$balance',
		'$new_balance'
		
		)";
		$result = mysqli_query($con,$sql) or die("Cant insert1 ".mysqli_error($con));
		if($result){
			//  $response = array('response'=>'success');
		 // echo json_encode($response);

		}

		}else{

			/////////////////the cant be debited///////////////////////
			 $response = array('response'=>'failed');
	   echo json_encode($response);

		}





  	} else if($response_code == 107){
  		//////////////////////////////////////// invalid phone //////////////
  		 $response = array('response'=>'invalid_phone');
	   echo json_encode($response);
  	} else if($response_code == 108){
  		//////////////////////////////////////// invalid phone //////////////
  		 $response = array('response'=>'unavailable');
	   echo json_encode($response);
  	}else{

			/////////////////other response from the mobile airtime///////////////////////
			 $response = array('response'=>'failed');
	   echo json_encode($response);

		}
		///////////////////////////////////// END///////




		}
	}



	////////////////////////////////// end of other network////////////////////////////

}


}

//////////////
//////////

////////////













////////////////////////////

<?php
if(isset($_GET['MTN'])){
	
$level = $_GET['level'];

if($level == "reseller"){

$response = array(
	'success',
	"1GB - ₦340",
	 "2GB - ₦660",
	 "3GB - ₦1,000",
	"4GB - ₦1,300",
	 "5GB - ₦1,600",
// 	"6GB - ₦2,110",
// 	 "7GB - ₦2,450",
// 	 "10GB - ₦3,000",
// 	 "15GB - ₦5,250"
	
);
echo json_encode($response);
}else{


$response = array(
	"1GB - ₦340",
	 "2GB - ₦650",
	 "3GB - ₦1,000",
	"4GB - ₦1,300",
	 "5GB - ₦1,600",
	"6GB - ₦2,110",
	 "7GB - ₦2,450",
	 "10GB - ₦3,000",
	 "15GB - ₦5,250"
 
 
	
);
echo json_encode($response);
}

}

if(isset($_GET['Airtel'])){
$response = array(

	'success',
  "750MB - ₦500(2wks)",
  "1.5GB - ₦1000",
  "2GB - ₦1200",
  "3GB - ₦1,500",
  "4.5GB - ₦2,000",
  "6GB = ₦2,500",
  "8GB = ₦3000"
	
	
	
);
echo json_encode($response);
}

if(isset($_GET['9mobile'])){

$response = array(
	
 'success',
 "500MB - ₦550",
 "1.5GB - ₦1050",
 
 "4.5GB - ₦2050",
 
 "15GB - ₦5050"
	
);
echo json_encode($response);
}






if(isset($_GET['Glo'])){

$response = array(
	'success',

 "920MB - ₦550(2wk)",
 "1.8GB - ₦1050",
  "4.5GB - ₦2050",
 "7.2GB - ₦2550",
 "8.75GB - ₦3050",
	
 "12.5GB - ₦4050",
 "15.6GB - ₦5550",
	
	
	
	
);

echo json_encode($response);
}



?>


?>