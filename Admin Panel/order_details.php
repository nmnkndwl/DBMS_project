<?php
  require('connection.inc.php');
  if(isset($_SESSION['Admin_login']) && $_SESSION['Admin_name']!=''){

  }
  else{
    header('location:login.php');
  }

  if(isset($_GET['id'])&& $_GET['id']!=''){
        $id=mysqli_real_escape_string($conn,$_GET['id']);
        $sql="select P.name,P.image,P.price,D.id, D.qty,D.order_status_id,S.status from order_details as D,order_status as S ,products as P where D.order_id='$id' and D.product_id=P.id and  D.order_status_id=S.id";
        $res=mysqli_query($conn,$sql);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <header>
            <div class="logo">
                <img src="./images/logo1.jpg" alt="logo">   
            </div>
            <div class="welcome">
                <div class="welcomea">
                <?php
                echo "<h2>Welcome  ".$_SESSION['Admin_name']."</h2>";
                ?>
                </div>
                <div class="logout">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </header>

        <div class="mainpage">
            <div class="sidebar">
                <a href="categories.php">Categories</a>
                <a href="products.php">Products</a>
                <a href="orders.php">Orders </a>
                <a href="users.php">Users </a>
                <a href="queries.php">Queries</a>
            </div>
            <div class="content">
               
                <div class="maincontent">
                    <h1>Order Details</h1>
                    <table class="table">
                        <thead>
                            <tr class="tabledata">
                                <th>Serial No.</th>  
                               <th>Image</th> 
                                <th>name</th>
                                <th>Qty</th>
                                <th>price</th>
                                <th>Total</th>
                                <th>Status</th>
                                
                            </tr>
                            <hr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                 while($row=mysqli_fetch_assoc($res)){ ?>

                                <tr class="tabledata">
                                    <td><?php echo $i ?> </td>
                                   <td><img class="product-img" src="../media/products/<?php echo $row["image"]?>"></td>
                                    <td><?php echo $row["name"]?></td>
                                
                                    <td><?php echo $row["qty"]?></td>
                                
                                    <td><?php echo $row["price"]?></td>
                                    <td><?php echo $row['qty']*$row['price']?></td>
                                    <td>
                                      <?php echo $row['status']."&nbsp;"  ?>
                                      <span class="edit"><a href="change_status.php?id=<?php echo $row["id"]?>&status_id=<?php echo $row['order_status_id']?>&order_id=<?php echo $id?>">Change Status</a></span>   
                                    </td>
                                    
                                </tr>

                                <?php  $i=$i+1;?>
                           <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
</body>
</html>
