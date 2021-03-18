<?php

session_start();

include 'conn.php';
if(!isset($_SESSION['username'])){
	header("Location: index.php?admin=admin");
	return;

}

if(isset($_POST['submit'])){
	$id = $_POST['id'];



	$sql = "SELECT * FROM transaction WHERE user_id = '$id' order by id desc";
	$result = mysqli_query($con,$sql) or die("cant insert".mysqli_error($con));


	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</head>
	<body>
	
	

	<button>
  <a href="logout.php">LOGOUT</a>
</button>

<div class="container">
            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>phone</th>
        <th>network</th>
        <th>amount</th>
        
         <th>transaction type</th>
        <th>date</th>
         <th>status</th>
        <th>data_plan</th>
        <th>topup_ref</th>
         <th>request_code</th>
        <th>old_balance</th>
         <th>new_balance</th>

      </tr>
    </thead>
    <tbody>


<?php

//$sql = "SELECT * FROM users";
$result = mysqli_query($con,$sql) or die("An error occoured ".mysql_error());
			$num = mysqli_num_rows($result);

				while ($row = mysqli_fetch_array($result)) {
					$phone = $row['phone_number'];
					$network = $row['network'];
					$amount = $row['amount'];
         			 $transaction_type = $row['transaction_type'];
					$purchase_date = $row['purchase_date'];
					$status = $row['status'];
         			 $data_plan = $row['data_plan'];
					$topup_ref = $row['topup_ref'];

					$request_code = $row['request_code'];
					$old_balance = $row['old_balance'];
         			 $new_balance = $row['new_balance'];
					//$topup_ref = $row['topup_ref'];




				
				

?>


      <tr>
      	<td><?php echo  $phone ?></td>
        <td><?php echo  $network?></td>
        <td><?php echo  $amount ?></td>
        <td><?php echo  $transaction_type ?></td>
         <td><?php echo  $purchase_date ?></td>
        <td><?php echo  $status ?></td>
        <td><?php echo  $data_plan  ?></td>
        <td><?php echo  $topup_ref ?></td>
        <td><?php echo  $request_code ?></td>

        <td><?php echo  $old_balance ?></td>
        <td><?php echo  $new_balance?></td>
       

    </tr>
       



	<?php
}
}




?>

</tbody>
  </table>
</div>

</body>
	</html>