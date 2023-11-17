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
        $delete_sql="delete from categories where id='$id'";
        mysqli_query($conn,$delete_sql);
    }
  }
  $sql="select O.*,A.local_address,A.town,A.city,A.pincode,A.state from orders as O ,addresses as A where O.address_id=A.id";
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
               
                <div class="maincontent">
                    <h1>Orders</h1>
                    <table class="table">
                        <thead>
                            <tr class="tabledata">
                                <th>Serial No.</th>
                                <th>Order Id</th>
                                <th>Date</th>
                                <th>Address</th>
                                <th>Payment Type</th>
                            </tr>
                            <hr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                 while($row=mysqli_fetch_assoc($res)){ ?>

                                <tr class="tabledata">
                                    <td><?php echo $i ?> </td>
                                    <td><a href="order_details.php?id=<?=$row['id']?>"><?php echo $row["id"]?></a></td>
                                    <td><?php echo $row["added_on"]?></td>
                                    <td>
                                         <?php echo $row['local_address'].","?>
                                         <?php echo $row['town'].","?>
                                         <?php echo $row['city'].","?>
                                         <?php echo $row['state'].","?>
                                         <?php echo $row['pincode']?>

                                    </td>
                                    <td><?php echo $row['payment_type']?></td>
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
