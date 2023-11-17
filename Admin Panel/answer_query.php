<?php
  require('connection.inc.php');
  if(isset($_SESSION['Admin_login']) && $_SESSION['Admin_name']!=''){

  }
  else{
    header('location:login.php');
  }

  if(isset($_GET['id']) && $_GET['id']!=''){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $res=mysqli_query($conn,"select * from queries where id='$id'");
    $row=mysqli_fetch_assoc($res);

   
 }
  

  if(isset($_POST['submit'])){
        $ans=mysqli_real_escape_string($conn,$_POST['ans']);
     
        $sql="update queries set ans='$ans' where id='$id' ";
        mysqli_query($conn,$sql);
        header('location:queries.php');
       
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
                    <h1>Query Answer form</h1>
                    <form method="post">
                       <div class="form-group">
                            <div class="label">Query</div>
                            <h2><?php echo $row['query']?></h2>
                        </div>
                        <div class="form-group">
                            <div class="label">Answer</div>
                            <input required type="text" name="ans" class="form-input" value=<?=$row['ans']?>>
                        </div>
                           
                          <button type="submit" name="submit" class="submit form-input">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    
</body>
</html>
