
<?php
require('connection.inc.php');
if(isset($_GET['id']) && $_GET['id']!=""){
  $id=$_GET['id'];
  $res=mysqli_query($conn,"select * from products where id='$id'");
  $row=mysqli_fetch_assoc($res);
}
?>



<?php 
 require('header.inc.php');
 ?>
          <div class="product-details">
              <div class="product-detail-box">
            
                   <div class="product-detail-image">
                      <img src="../media/products/<?php echo $row['image']?>" >
                   </div>
                   <div class="product-detail-info">
                             <h2><?php echo $row['name']?></h2>
                                      
                             <p class="product-price">
                              MRP <span class="discount-price">₹<?php echo $row['mrp']?></span> 
                              </p>
                              <p class="product-price">Price ₹<?php echo $row['price']?></p>
                
                  
                              <a class="add-to-cart" href="add_to_cart.php?product_id=<?php echo $row['id']?>" >Add to Cart</a>
                   </div>
              </div>
          </div>
<?php
require('footer.inc.php') ;
?>    