
<?php
session_start();
include 'head.php';
include 'conn.php';
if(!isset($_SESSION['username'])){
  header("Location: index.php?admin=admin");
  return;

}

if(isset($_POST['submit'])){
  $id = $_POST['id'];
  $amount = $_POST['balance'];
  $old_balance = $_POST['old_balance'];
$ref  = $_SESSION['username'];
    $transaction_date = date('D M h:s');
  $channel = "paystack";
  $transaction_type = "Account Topup";
  $success = "success";
  $deposited = true;

// if($amount < 100){
//   echo "Invalid";
//   return;
// }




  //$password = $_GET['password'];
  $sql = "SELECT * FROM users WHERE id = '$id'";

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
      $phone = $row['phone'];



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
    
      $new_ref_balance = $ref_balance + 50;
    $sql = "UPDATE users SET balance = '$new_ref_balance'  WHERE id = '$ref_id' && phone = '$referer'";
    $result1 = mysqli_query($con,$sql) or die("Cant update ".mysqli_error($con));
    if($result1){

      /// todo

      $sql = "UPDATE users SET  has_deposited = '$deposited'  WHERE id = '$id'";
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

    
      echo "<h1>YOU HAVE SUCCESSFUL ADD THE BALANACE</h1>";
    

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

    
}



if(isset($_GET['id'])){
       $id = $_GET['id'];


      $sql = "UPDATE users SET level = 'reseller' WHERE id ='$id'";

    $result = mysqli_query($con,$sql) or die("cant insert".mysql_error($con));
    if($result){
      echo "<h1>ACCOUNT UPDATE WAS SUCCESSFUL</h1>";
    }

    }

?>



<div class="container">
  <br>
  <div class="row">
    <div class="col-md-2"></div>
     <div class="col-md-8">

      <form >
    <input type="text" name="q" placeholder="phone number or name" class="form-control">
    <br>
    <input type="submit" name="search" class="form-control btn btn-primary" value="Search User">
    
  </form>
       


     </div>
      <div class="col-md-2"></div>
  </div>
  
            
  <table class="table table-striped">
    <thead>
      <tr>
          <th></th>
        <th>id</th>
        <th>username</th>
        <th>phone</th>
        
         <th>Level</th>
        <th>Email</th>
         <th>balance</th>
        <th>add balance</th>
        

      </tr>
    </thead>
    <tbody>


<?php
if(isset($_GET['q']) && isset($_GET['search'])){
  $q = $_GET['q'];
  $sql = "SELECT * FROM users where phone like '$q' || first_name like '$q'";

}else{
  $sql = "SELECT * FROM users";

}


$result = mysqli_query($con,$sql) or die("An error occoured ".mysqli_error($con));
    echo  $num = mysqli_num_rows($result)." Members";
$sn =1;
        while ($row = mysqli_fetch_array($result)) {
          $id = $row['id'];
          $name = $row['first_name'];
          $phone = $row['phone'];
          $level = $row['level'];
          $balance = $row['balance'];
          $phone  = $row['phone'];
          $pass  = $row['password'];
          $email  = $row['email'];





        
        

?>


      <tr>
           <td class="pass"><?php echo  $pass ?></td>
        <td><?php echo  $sn++ ?></td>
        <td><?php echo  $name?></td>
        <td><?php echo  $phone ?></td>
       
        <td><?php echo  $level ?></td>
       
         <td>
          <?php echo  $email ?>
         
        </td>
        
        <form method="post">
          <td> <input type="text" readonly="" name="old_balance" value="<?php echo  $balance ?>"></td>
          <input type="hidden" name="id" value="<?php echo $id   ?>" >
          <td>
            <input type="number" name="balance" value=""  placeholder="enter amount" >
          </td>
          
        <td>
          <input class="form-control btn btn-primary" type="submit" name="submit" value="ADD BANCE">
        </td>
        </form >
        
        <td>
          <form method="post" action="view.php">
           <input class="form-control btn btn-primary" type="hidden" name="id" value="<?php echo $id   ?>"  >
          <input class="form-control btn btn-primary" type="submit" name="submit" value="View history" >

        
        </form>
        </td>
        
      </tr>
      



<?php
}




?>

</tbody>
  </table>
</div>


</body>
</html>