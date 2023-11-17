<?php
  require('connection.inc.php');
  if(isset($_SESSION['Admin_login']) && $_SESSION['Admin_name']!=''){

  }
  else{
    header('location:login.php');
  }

  if(isset($_GET['id']) && $_GET['id']!=''){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $order_id=mysqli_real_escape_string($conn,$_GET['order_id']);
    $status_id=mysqli_real_escape_string($conn,$_GET['status_id']);
 }
  

  if(isset($_POST['change'])){
      $status_id=mysqli_real_escape_string($conn,$_POST['status']);
      if($status_id==5){
        $sql="update order_details set order_status_id='$status_id',payment_status='complete' where id='$id' ";
        mysqli_query($conn,$sql);
        header("location:order_details.php?id=$order_id");
      }
      else{
        $sql="update order_details set order_status_id='$status_id' where id='$id' ";
        mysqli_query($conn,$sql);
        header("location:order_details.php?id=$order_id");
      }
        
       
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
                <a href="users.php">Users</a>
                <a href="queries.php">Queries</a>
            </div>
            <div class="content">
                <div class="maincontent">
                    <h1>Change Status</h1>
                    <form method="post">
                    <div class="form-group">
                           <div class="label">Status</div>
                            <select required name="status" class="form-input">
                                <?php
                                $res=mysqli_query($conn,"select * from order_status");
                                while($row=mysqli_fetch_assoc($res)){
                                      if($row['id']==$status_id){
                                        echo "<option selected value=".$row["id"].">".$row["status"]."</option>";
                                      }
                                      else{
                                        echo "<option value=".$row["id"].">".$row["status"]."</option>";
                                      }
                                   
                                }
                                ?>
                            </select>
                        </div>
                          <button type="submit" name="change" class="submit form-input">Change</button>
                    </form>
                    
                </div>
            </div>
        </div>
    
</body>
</html>
