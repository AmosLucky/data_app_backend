
<?php
include 'conn.php';
if(isset($_POST['deposit'])){
	 $phone = $_POST['phone'];
	$password = $_POST['password'];
	$amount = $_POST['amount'];
	$ref = $_POST['ref'];
	$transaction_date = date('D M h:s');
	$channel = "paystack";
	$transaction_type = "Account Topup";
	$success = "success";
	$deposited = true;






	//$password = $_GET['password'];
	$sql = "SELECT * FROM users WHERE phone = '$phone' && password = '$password'";

	$result = mysqli_query($con,$sql) or die("Cant login ".mysqli_error($con));
	//$response[];
	$num_row = mysqli_num_rows($result);

	if($num_row == 1){
		while ($row = mysqli_fetch_array($result)) {
			$id = $row['id'];
			$balance = $row['balance'];
			$username = $row['first_name'];
			$has_deposited = $row['has_deposited'];
			$referer = $row['referer'];


			# code...
		}

		//// to credit the referer

			if($has_deposited ==  false){
				///// to credite refer

				$sql = "SELECT * FROM users WHERE phone = '$referer'";

	$result = mysqli_query($con,$sql) or die("Cant login ".mysqli_error($con));
	//$response[];
	$num_row = mysqli_num_rows($result);

	if($num_row == 1){
		while ($row = mysqli_fetch_array($result)) {
			$ref_id = $row['id'];
			$ref_balance = $row['balance'];
			$ref_username = $row['first_name'];
			
			

			# code...
		}
		
			$new_ref_balance = $ref_balance + 100;
		$sql = "UPDATE users SET balance = '$new_ref_balance'  WHERE id = '$ref_id' && phone = '$referer'";
		$result = mysqli_query($con,$sql) or die("Cant update ".mysqli_error($con));
		if($result){
			/// todo

			$sql = "UPDATE users SET  has_deposited = '$deposited'  WHERE phone = '$phone' && password = '$password'";
		$result = mysqli_query($con,$sql) or die("Cant update ".mysqli_error($con));
		if($result){

		}

		}
	}
			}

		
			$new_balance = $balance + $amount;
		$sql = "UPDATE users SET balance = '$new_balance' WHERE id = '$id'";
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
			channel,
			topup_ref,
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
		'$channel',
		'$ref',
		'$balance',
		'$new_balance'
		
		)";
		$result = mysqli_query($con,$sql) or die("Cant insert1 ".mysqli_error($con));
		if($result){

		
			 $response = array('response'=>'success');
		echo json_encode($response);
		

		}else{
			 $response = array('response'=>'failed');
		echo json_encode($response);

		}

		}else{
			 $response = array('response'=>'failed');
		echo json_encode($response);

		}

	

	}else{
		$response = array('response'=>'failed');
		echo json_encode($response);
		
	}
	//echo "Pppp";
}else{
		$response = array('response'=>'failed');
		echo json_encode($response);
		
	}
	?>

