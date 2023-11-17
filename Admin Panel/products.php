<?php
  require('connection.inc.php');
  if(isset($_SESSION['Admin_login']) && $_SESSION['Admin_name']!=''){

  }
  else{
    header('location:login.php');
  }

  if(isset($_GET['type'])&& $_GET['type']!=''){
    $type=mysqli_real_escape_string($conn,$_GET['type']);
    if($type=='delete'){
        $id=mysqli_real_escape_string($conn,$_GET['id']);
        $delete_sql="delete from products where id='$id'";
        mysqli_query($conn,$delete_sql);
    }

  }
  $sql="select P.*,C.category from products as P,categories as C where P.category_id=C.id order by P.id ";
  $res=mysqli_query($conn,$sql);
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
               <h1> <a href="insert_products.php">Add Products</a></h1> 
                <div class="maincontent">
                    <h1>Products</h1>
                    <table class="table">
                        <thead>
                            <tr class="tabledata">
                                <th>Serial No.</th>  
                                <th>Id</th>
                               <th>Image</th>
                                <th>name</th>
                                <th>category</th>
                                <th>Qty</th>
                                <th>mrp</th>
                                <th>price</th>
                                <th>Action</th>
                                
                            </tr>
                            <hr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                 while($row=mysqli_fetch_assoc($res)){ ?>

                                <tr class="tabledata">
                                    <td><?php echo $i ?> </td>
                                    <td><?php echo $row["id"]?></td>
                                  <td><img class="product-img" src="../media/products/<?php echo $row["image"]?>"></td>
                                    <td><?php echo $row["name"]?></td>
                                    <td><?php echo $row["category"]?></td>
                                    <td><?php echo $row["qty"]?></td>
                                    <td><?php echo $row["mrp"]?></td>
                                    <td><?php echo $row["price"]?></td>
                                    <td>
                                         <span class="edit"><a href="update_products.php?type=update&id=<?php echo $row["id"]?>">Edit</a></span>&nbsp;
                                         <span class="delete"><a href="?type=delete&id=<?php echo $row["id"]?>">Delete</a></span>
                                         
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
