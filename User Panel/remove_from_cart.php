<?php 
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){
  if(isset($_GET['product_id']) && $_GET['product_id']!=""){
    $product_id=$_GET['product_id'];
    $user_id=$_SESSION['User_id'];
        $sql="delete from cart where product_id='$product_id' and user_id='$user_id'";
        mysqli_query($conn,$sql);
        header('location:user_cart.php');
   }
   
 }
 else{
    header('location:index.php');
   } 
?>