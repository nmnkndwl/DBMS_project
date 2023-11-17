<?php
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){

}
else{
   header('location:index.php');
}
$user_id=$_SESSION['User_id'];

if(isset($_POST['cancel'])){
    $id=mysqli_real_escape_string($conn,$_POST['D_id']);
    mysqli_query($conn,"update order_details set order_status_id=4 where id='$id'" );
    $qty=mysqli_real_escape_string($conn,$_POST['qty']);
    $product_id=mysqli_real_escape_string($conn,$_POST['product_id']);
    mysqli_query($conn,"update products set qty=qty+'$qty' where id='$product_id'");
}
$sql="select P.image,P.price,P.id as product_id,D.id as D_id ,D.qty,S.status,D.order_status_id ,D.payment_status,A.* from orders as O,order_details as D ,order_status as S,products as P ,addresses as A where O.id=D.order_id and P.id=D.product_id and O.address_id=A.id and D.order_status_id=S.id and O.user_id='$user_id'";
$orders=mysqli_query($conn,$sql);
?>


<?php 
 require('header.inc.php');
 ?>
          <div class="myorders-page">
              <div class="orders">
                <?php
                while($row=mysqli_fetch_assoc($orders)){?>
                    <div class="ordered-item-box">
                            <div class="ordered-item-img">
                                 <img src="../media/products/<?php echo $row['image']?>" alt="">
                            </div>
                            <div class="delivery-address">
                                          
                             <h3><?php echo $row['name']?></h3> 
                            <h3><?php echo $row['local_address']?></h3>
                            <h3><?php echo $row['city'].", ".$row['state'].", ".$row['pincode']?></h3>
                            <h3><?php echo "Mobile: ".$row['mobile']?></h3>           
                            </div>
                            <div class="orders-item-details">
                            <h3><?php echo "Qty: ".$row['qty']?></h3> 
                            <h3><?php echo "Price ₹".$row['price']?></h3>
                            <h3><?php echo "Total ₹".$row['price']*$row['qty']?></h3>
                            </div>
                            <div class="order-cancel">
                                <h3><?php echo "Status : ".$row['status']?></h3>
                                <h3><?php echo "Payment: ".$row['payment_status']?></h3>
                                <?php
                                     if($row['order_status_id']==5){
                                        echo "<h3>Delivered</h3>";
                                     }
                                     else if($row['order_status_id']==4){
                                        echo "<h3>Cancelled</h3>";
                                     }
                                     else{?>
                                        <form method="post">
                                           <input type="hidden" name="qty" value=<?=$row['qty']?>>
                                            <input type="hidden" name="product_id" value=<?=$row['product_id']?>>
                                            <input type="hidden" name="D_id" value=<?=$row['D_id']?>>
                                          <button type="submit" name="cancel"> Cancel</button>
                                        </form>
                                        
                                    <?php }
                                ?>
                               
                                
                                
                            </div>

                    </div>       
                <?php
                }
                ?>
              </div>
          </div>
<?php
require('footer.inc.php') ;
?>    