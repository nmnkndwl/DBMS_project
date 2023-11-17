<?php 
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){
  if(isset($_GET['product_id']) && $_GET['product_id']!=""){
    $product_id=$_GET['product_id'];
    $user_id=$_SESSION['User_id'];
    $qty=1;
    $check=mysqli_num_rows(mysqli_query($conn,"select * from cart where product_id='$product_id' and user_id='$user_id'"));
    if($check>0){
        $sql="update cart set qty=qty+1 where product_id='$product_id' and user_id='$user_id'";
        mysqli_query($conn,$sql);
        header('location:user_cart.php');
    }
    else{
        $sql="insert into cart (product_id,user_id,qty) values ('$product_id','$user_id','$qty')";
        mysqli_query($conn,$sql);
        header('location:user_cart.php');
    }
   }
   
 }
 else{
    header('location:login.php');
   } 
?>