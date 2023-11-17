<?php
  require('connection.inc.php');
  if(isset($_SESSION['Admin_login']) && $_SESSION['Admin_name']!=''){

  }
  else{
    header('location:login.php');
  }

  $msg="";
  if(isset($_POST['submit'])){
    $category=mysqli_real_escape_string($conn,$_POST['category']);
    $check=mysqli_query($conn,"select * from categories where category='$category'");
    if(mysqli_num_rows($check)>0){
        $msg="Category already exist";
    }
    else{
        $sql="insert into categories(category) values('$category')";
        mysqli_query($conn,$sql);
        header('location:categories.php');
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
                <a href="users.php">Users </a>
                <a href="queries.php">Queries</a>
            </div>
            <div class="content">
                <div class="maincontent">
                    <h1>Category form</h1>
                    <form method="post">
                        <div class="form-group">
                            <div class="label">Category</div>
                            <input type="text" name="category" class="form-input"required>
                        </div>
                           
                          <button type="submit" name="submit" class="submit form-input">Submit</button>
                    </form>
                    <div class="contenterrormsg">
                        <?php
                        echo $msg;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html>
