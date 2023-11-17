<?php
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){

}
else{
   header('location:index.php');
}
$_SESSION['check']='false';
$user_id=$_SESSION['User_id'];
$sql="select P.name,P.id,P.mrp,P.price,P.image,P.qty as product_qty,C.qty from cart as C,products as P where C.product_id=P.id and C.user_id='$user_id' ";
$items=mysqli_query($conn,$sql);
 $total=0;
 $totalmrp=0;
 $discount=0;
?>


<?php
 if(isset($_POST['remove'])){
   $address_id=mysqli_real_escape_string($conn,$_POST['address_id']);
   mysqli_query($conn,"delete from addresses where id='$address_id'");
   header('location:place_order.php');
 }

 $selected_address="";
 if(isset($_POST['confirm-address'])){
   if(isset($_POST['address'])){
      $selected_address=mysqli_real_escape_string($conn,$_POST['address']);
      $_SESSION['address']=$selected_address;
   }
  else{
   echo "choose a address";
  }
    
 }


 if(isset($_POST['cod'])){
   mysqli_autocommit($conn,false);
   try{
      $address_id=$_SESSION['address'];
      $payment_type="cod";
      $payment_status="incomplete";
      $amount=mysqli_real_escape_string($conn,$_POST['amount']);
      $order_status_id=1;
      $sql="insert into orders (user_id,address_id,amount,payment_type) values('$user_id','$address_id','$amount','$payment_type')";
      mysqli_query($conn,$sql);
  
      $order_id=mysqli_insert_id($conn);
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
      header('location:thank_you.php');
   }
   catch(Exception $e){
      mysqli_rollback($conn);
      header('location:user_cart.php');
   }
   
   
 }

?>


<?php
 $addresses=mysqli_query($conn,"select * from addresses where user_id='$user_id'");
 
 ?>
<?php 
 require('header.inc.php');
 ?>
          <div class="placing-order-page">
             <div class="placing-order-details">
                      
                      <div class="placing-address-details">
                         <button onclick="displayAddress()"><b>+  Address Information</b></button>
                         <div class="placing-addresses" id="addresses">
                           <form method="post">
                           <?php
                                   while($address=mysqli_fetch_assoc($addresses)){?>
                                   
                                    <div class="address-item-box">
                                       
                                            
                                       <div class="address-select">
                                          <input type="radio" name="address" value="<?=$address['id']?>">
                                       </div>
                        
                                              
                                              
                                       
                                         
                                       
                                       
                           
                                          <div class="address-item">
                                          
                                            <h3><?php echo $address['name']?></h3> 
                                            <h3><?php echo $address['local_address']?></h3>
                                            <h3><?php echo $address['city'].", ".$address['state'].", ".$address['pincode']?></h3>
                                            <h3><?php echo "Mobile: ".$address['mobile']?></h3>
                                          
                                          
                                          </div>
                                          <div class="address-update">
                                               
                                                <input type="hidden" name="address_id" value="<?= $address['id']?>">
                                                 <button type="submit" name="remove">Remove</button>
                                             
                                              <a href="edit_address.php?address_id=<?php echo $address['id']?>">Edit</a>
                               
                                          </div>
            
      
                                     </div>
                                  <?php }
                                ?>
                              <input class="confirm-address" type="submit" name="confirm-address" value="Confirm Address"></input>
                             <a href="addnew_address.php">Add New Address</a>
                           </form>                 
                           </div>
                      </div>
         
               <h1>Review Items</h1>
                 <?php
                 while($row=mysqli_fetch_assoc($items)){
                    $subtotal=$row['price']*$row['qty'];
                          
                    $total=$total+$subtotal;
                    $totalmrp=$totalmrp+$row['mrp']*$row['qty'];
                    $discount=$discount+$totalmrp-$total;

                    if($row['qty']>0){
                     ?>
                          <div class="placing-item">
                           <div class="placing-item-img">
                              <img src="../media/products/<?php echo $row['image']?>">
                           </div>
                           <div class="placing-item-details">
                              <h2><?php echo $row['name']?></h2>
                              <p class="placing-price">Qty : <?php echo $row['qty']?></p>                  
                              <p class="placing-price">Price ₹<?php echo $row['price']?></p>
                              <p class="placing-price green">Total ₹<?php echo $subtotal?></p>
                           </div>
                        </div>
                    <?php
                    }
                  }
                 ?>
             </div>
            <?php
            if($selected_address!=""){?>
               <div class="payment-details">
               <p ><strong>MRP:</strong>
               <strong class="mrp">₹<?php echo $totalmrp ?></strong></p>
               <p > <strong>Discount:</strong>
               <strong class="discount">₹<?php echo $discount ?></strong></p>
               <p > <strong>Total:</strong>
               <strong class="price" >₹<?php echo $total ?></strong></p>
               <button onclick="displaypayment()">Place Order</button>
               <div class="payment-options" id="payment-option-select">
                  <h2>Select pay method to Confirm  order</h2>
                  <form method="post">
                     <input type="hidden" name="amount" id="total-amount" value=<?=$total?>>
                    <button type="submit" name="cod">COD</button>
                  </form>
                 
                  <button onclick="makepayment()">RazorPay</button>
               </div>
               
                  
                
                
         </div>
           <?php }
            ?>
             
      </div>
<?php
require('footer.inc.php') ;
?> 






<script>
 function displayAddress() {
   var element = document.getElementById("addresses");
            
            if (!element.classList.contains("show")) {
                element.classList.add("show");
            }
            else{
               element.classList.remove("show");
            }
 }
</script>

<script>
 function displaypayment() {
   var element = document.getElementById("payment-option-select");
            
            if (!element.classList.contains("showpayment")) {
                element.classList.add("showpayment");
            }
            else{
               element.classList.remove("showpayment");
            }
           
 }
</script>

<script>
   function makepayment(){
        var amt=<?=$total?>;
        
            var options = {
                              "key": "rzp_test_Y8S7KwAGDT6BDr", // Enter the Key ID generated from the Dashboard
                              "amount": amt*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                              "currency": "INR",
                              "name": "Ecommerce App",
                              "description": "Test Transaction",
                              "image": "https://example.com/your_logo",
                              //"order_id": "order_IluGWxBm9U8zJ8", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                              "handler": function (response){
                                    jQuery.ajax({
                                       type:"POST",
                                       url:"payment.php",
                                       data:"amt="+amt+"payment_id="+response.razorpay_payment_id,
                                       
                                       success:function(result){
                                          window.location.href="thank_you.php";
                                       }

                                    })
                              },
                              "notes": {
                                 "address": "Razorpay Corporate Office"
                              },
                              "theme": {
                                 "color": "#3399cc"
                              }
                           };
                           var rzp1 = new Razorpay(options);
                           rzp1.open(); 
        
                 
         
    }
</script>





 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script src="https://checkout.razorpay.com/v1/checkout.js"></script>








