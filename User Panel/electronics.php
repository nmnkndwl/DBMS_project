<?php 
require('connection.inc.php');
$sql="select P.* from products as P,categories as C where P.category_id=C.id and c.category='electronics' order by rand() ";
$res=mysqli_query($conn,$sql);
?>

<?php 
 require('header.inc.php');
 ?>
          <div class="main">
            <div class="main-content">
                 <?php
                      while($row=mysqli_fetch_assoc($res)){?>
                         <a class="product-link" href="product-details.php?id=<?php echo $row["id"]?>">
                            <div class="product-card">
                                    <img  src="../media/products/<?php echo $row["image"]?>" alt=" photo upload">
                                    <div class="product-info">
                                      <h2><?php echo $row['name']?></h2>
                                      
                                      <p class="product-price">
                                        <span class="discount-price">₹<?php echo $row['mrp']?></span> ₹<?php echo $row['price']?>
                                      </p>
                                      <!-- <a class="add-to-cart" href="?id=<?php echo $row['id']?>" >Add to Cart</a> -->
                                      
                                    </div>
                              </div>
                        </a>
                          
                          
                    <?php }
                  ?>
             </div> 
             <div class="filters">
             </div>  
          </div>
<?php
require('footer.inc.php') ;
?>    