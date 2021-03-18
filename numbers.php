<?php
include 'conn.php';
$sql = "SELECT  * FROM users where balance < 5";
$result = mysqli_query($con,$sql) or die("An error occoured ".mysql_error());
		 $num = mysqli_num_rows($result)." Members";
      $sn = 1;

				while ($row = mysqli_fetch_array($result)) {
					
					
					$phone = $row['phone'];
					$name = $row['first_name'];
					 $phone." $name</br>";

				?>
				

<tr>
	<td><?php echo $sn ++. " ".  $phone." $name"; ?> <a href="tel:<?php echo  $phone?>"><button style="padding: 20px">save</button></a></td></br>
	
	
</tr>



          
<?php
				}
?>