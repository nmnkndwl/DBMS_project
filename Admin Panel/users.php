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
        $delete_sql="delete from users where id='$id'";
        mysqli_query($conn,$delete_sql);
    }

  }
  $sql="select * from users";
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
                  <h1>Users</h1>
                    <table class="table">
                        <thead>
                            <tr class="tabledata">
                                <th>Serial No.</th>  
                                <th>Id</th>
                                <th>name</th>
                                <th>email</th>
                                <th>mobile</th>
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
                                
                                    <td><?php echo $row["name"]?></td>
                                    <td><?php echo $row["email"]?></td>
                                    <td><?php echo $row["mobile"]?></td>
                                    <td>
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
