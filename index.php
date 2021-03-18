
	<?php
	
	include 'conn.php';
	session_start();


		if(isset($_POST['submit'])){
			$username = $_POST['username'];
			$password = $_POST['password'];

			$sql = "SELECT * FROM admin where username = '$username' && password = '$password'";
			$result = mysqli_query($con,$sql) or die("An error occoured ".mysql_error());
			$num = mysqli_num_rows($result);
			if($num == 1){
				while ($row = mysqli_fetch_array($result)) {
					$_SESSION['username'] = $row['username'];

					

//echo "pp";
					
				}
				echo "<script type='text/javascript'>
			window.location.href = 'admin_dashboard.php';
		</script>";

				
			}else{
				echo "username Not Correct";
			}
		}



		?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>



		<form method="post">
		<input type="text" name="username">
		<br>
		<input type="text" name="password">
		<br>
		<input type="submit" name="submit">
		
	</form>


	

</body>
</html>