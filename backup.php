<?php
if(isset($_GET['MTN'])){
	
$level = $_GET['level'];
if($level == "reseller"){

$response = array(
	'success',
	"1GB - ₦360",
	 "2GB - ₦720",
	 "3GB - ₦1,080",
	"4GB - ₦1,440",
	 "5GB - ₦1,800",
	"6GB - ₦2,110",
	 "7GB - ₦2,450",
	 "10GB - ₦3,000",
	 "15GB - ₦5,250"
	
);
echo json_encode($response);
}else{


$response = array(
	'success',
 "1GB - ₦3,90",
 "2GB - ₦7,50",
 "3GB - ₦1,130",
 "4GB - ₦1,450",
 "5GB - ₦1,800",
 "6GB - ₦1,170",
 "7GB - ₦2,530",
 "10GB - ₦3,600",
 "15GB - ₦5,450"
 
 
	
);
echo json_encode($response);
}

}

if(isset($_GET['Airtel'])){
$response = array(

	'success',
  "750MB - ₦490(2wks)",
  "1.5GB - ₦980",
  "3GB - ₦1470",
  "6GB - ₦2,450",
  "11GB - ₦3,950",
  "15GB = ₦4,900",
  "40GB = ₦9850"
	
	
	
);
echo json_encode($response);
}

if(isset($_GET['9mobile'])){

$response = array(
	
 'success',
 "1GB - ₦950",
 "1,5GB - ₦1,150",
 "2,5GB - ₦1;850",
 "15GB - ₦14,600"
	
);
echo json_encode($response);
}






if(isset($_GET['Glo'])){

$response = array(
	'success',

 "1GB - ₦480(2wk)",
 "2.5GB - ₦950", "5.8GB - ₦1,900",
 "7.7GB - ₦2,400",
 "10GB - ₦2,850",
	
 "13.2GB - ₦3,900",
 "18.2GB - ₦4,650",
	
	
	
	
);

echo json_encode($response);
}



?>