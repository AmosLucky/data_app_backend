<?php
include("Conn.php");
if(isset($_GET['history']) && isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "SELECT * FROM transaction WHERE user_id ='$id' && request_type != 'double 2' order by id desc";
	$result = mysqli_query($con,$sql) or die("Cant Select ".mysqli_error($con));
	$res =  array();
 while ($row = mysqli_fetch_assoc($result)){
 	$res[] = $row;
 }
 echo json_encode($res);


}


?>