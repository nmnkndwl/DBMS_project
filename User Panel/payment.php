<?php
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){

}
else{
   header('location:index.php');
}
$user_id=$_SESSION['User_id'];

if(isset($_POST['amt'])){
   mysqli_autocommit($conn,false);
   try{
      $amount=mysqli_real_escape_string($conn,$_POST['amt']);
      $address_id=$_SESSION['address'];
      $payment_type="razorpay";
      $payment_status="complete";
      $order_status_id=1;
      $sql="insert into orders (user_id,address_id,amount,payment_type) values('$user_id','$address_id','$amount','$payment_type')";
      mysqli_query($conn,$sql);
  
      $order_id=mysqli_insert_id($conn);
      $SESSION['order_id']=$order_id;
      $cart=mysqli_query($conn,"select * from cart where user_id='$user_id' and qty>0");
      while($row=mysqli_fetch_assoc($cart)){
         $product_id=$row['product_id'];
         $qty=$row['qty'];
         mysqli_query($conn,"update products set qty=qty-'$qty' where id='$product_id'");
         mysqli_query($conn,"insert into order_details(order_id,product_id,qty,order_status_id,payment_status) values('$order_id','$product_id','$qty','$order_status_id','$payment_status')");
      }
      $delete_cart="delete from cart where user_id='$user_id' and qty>0";
      mysqli_query($conn,$delete_cart);
      mysqli_commit($conn);
   }
   catch(Exception $e){
        mysqli_rollback($conn);
        header('location:user_cart.php');
   }
    
}


?>