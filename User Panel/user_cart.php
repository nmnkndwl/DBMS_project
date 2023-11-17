<?php
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){

}
else{
   header('location:login.php');
}
$user_id=$_SESSION['User_id'];
$sql="select P.name,P.id,P.mrp,P.price,P.image,P.qty as product_qty,C.qty from cart as C,products as P where C.product_id=P.id and C.user_id='$user_id' ";
$res=mysqli_query($conn,$sql);
$isempty=mysqli_num_rows($res);
$total=0;
$totalmrp=0;
$discount=0;

?>

<?php 
if (isset($_POST['decrease_quantity'])) {
   $product_id = $_POST['product_id'];
   $cart_qty=$_POST['update_qty'];
   
   if($cart_qty>0){
      $cart_qty=$cart_qty-1;
      $sql="update cart set qty='$cart_qty' where product_id='$product_id' and user_id='$user_id'";
      mysqli_query($conn,$sql);
      header('refresh:0');
   }
   
}
if (isset($_POST['increase_quantity'])) {
   $product_id = $_POST['product_id'];
   $check=mysqli_fetch_assoc(mysqli_query($conn,"select * from products where id='$product_id' "));
   $cart_qty=$_POST['update_qty'];
   if($check['qty']>$cart_qty){
      $cart_qty=$cart_qty+1;
      if($cart_qty>15){
         
      }
      else{
         $sql="update cart set qty='$cart_qty' where product_id='$product_id' and user_id='$user_id'";
         mysqli_query($conn,$sql);
         header('refresh:0');
         
           
      }
     
   }  
}

?>

<?php 
 require('header.inc.php');
 ?>
          
<?php if($isempty>0){?>
   <div class="cart">
      <div class="cart-items-box">
         <?php
          while($row=mysqli_fetch_assoc($res)){
               if($row['product_qty']<$row['qty']){
                  $row['qty']=$row['product_qty'];
                  $product_id=$row['id'];
                  $set_qty=$row['product_qty'];
                  mysqli_query($conn,"update cart set qty='$set_qty' where product_id=$product_id and user_id='$user_id'");
               }
               $subtotal=$row['price']*$row['qty'];
                          
               $total=$total+$subtotal;
               $totalmrp=$totalmrp+$row['mrp']*$row['qty'];
               $discount=$discount+$totalmrp-$total;
         ?>
                           
         <div class="cart-item" id="<?= $row['id']?>">
            <div class="cart-item-img">
               <img src="../media/products/<?php echo $row['image']?>">
            </div>
            <div class="cart-item-details">
               <div class="cart-item-details-box">
                  <h2><?php echo $row['name']?></h2>
                                                
                  <p class="product-price">
                   MRP <span class="discount-price">₹<?php echo $row['mrp']?></span> 
                  </p>
                  <p class="product-price">Price ₹<?php echo $row['price']?></p>
                  <form method="post">
                     <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                     <input type="submit" name="decrease_quantity" value="-">
                     <input type="hidden" name="update_qty" value="<?= $row['qty']?>">
                     <?php   echo $row['qty']; ?>
                                                   
                     <input type="submit" name="increase_quantity" value="+">
                  </form>
                  <p class="product-price"><?php
                                               
                                                  if($row['product_qty']>0){
                                                    echo "<i class='green'>In Stock</i>";
                                                  }
                                                  else{
                                                    echo "<i class='red'>Out of Stock</i>";
                                                  }
                                                ?>
                  </p>
                                                <p class="product-price">Total ₹<?php echo $subtotal?></p>
               </div>
               <div class="remove_from_cart">
                   <a href="remove_from_cart.php?product_id=<?php echo $row['id']?>"><h2> <i class="fa-solid fa-x"></i></h2></a>
               </div>
                                 

            </div>
         </div>
        <?php
         } ?>
      </div>
                     

      <div class="cart-place-order">
         <p ><strong>MRP:</strong>
         <strong class="mrp">₹<?php echo $totalmrp ?></strong></p>
         <p > <strong>Discount:</strong>
         <strong class="discount">₹<?php echo $discount ?></strong></p>
         <p > <strong>Total:</strong>
         <strong class="price" >₹<?php echo $total ?></strong></p>
 

         <a href="
                        <?php if($total>0){
                            echo "place_order.php";
                        }?>
                       ">Place Order
         </a>
      </div>
   </div>
   <?php }
else{?>
      <div class="empty-cart">
       <h1>Hey <?php echo $_SESSION['User_name'] ?> your cart is empty</h1>
       <a href="index.php">Continue Shopping <i class="fas fa-arrow-right"></i></a>
      </div>
          <?php }
           ?>
          
<?php
require('footer.inc.php') ;
?>  