
<?php
if(isset($_GET['MTN'])){
	
$level = $_GET['level'];

if($level == "reseller"){

$response = array(
	'success',
	"1GB - ₦300",
	 "2GB - ₦600",
	 "3GB - ₦900",
	// "4GB - ₦1,200",
	 "5GB - ₦1,450",
 	"10GB - ₦2,800",
	 "15GB - ₦4,200",
	 "20GB - ₦5,400",
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