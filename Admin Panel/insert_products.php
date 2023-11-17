<?php
  require('connection.inc.php');
  if(isset($_SESSION['Admin_login']) && $_SESSION['Admin_name']!=''){

  }
  else{
    header('location:login.php');
  }


  $name="";
  $category_id="";
  $qty="";
  $mrp="";
  $price="";
  $image="";
  $description="";

  $msg="";
  if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $category_id=mysqli_real_escape_string($conn,$_POST['category']);
    $qty=mysqli_real_escape_string($conn,$_POST['qty']);
    $mrp=mysqli_real_escape_string($conn,$_POST['mrp']);
    $price=mysqli_real_escape_string($conn,$_POST['price']);
    $description=mysqli_real_escape_string($conn,$_POST['description']);


        $image=rand(111111,999999)."_".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'../media/products/'.$image);
        $sql="insert into products(name,category_id,qty,mrp,price,image,description) values('$name','$category_id','$qty','$mrp','$price','$image','$description')";
        mysqli_query($conn,$sql);
        header('location:products.php');
   
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
                    <h1>Product form</h1>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                           <div class="label">Category</div>
                            <select required name="category" class="form-input">
                                <option>Select Category</option>
                                <?php
                                $res=mysqli_query($conn,"select id,category from categories order by category desc");
                                while($row=mysqli_fetch_assoc($res)){
                                    echo "<option value=".$row["id"].">".$row["category"]."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="label">Product Name</div>
                            <input required type="text" name="name" class="form-input" value=<?php echo $name?> >
                        </div>
                        <div class="form-group">
                            <div class="label">Quantity</div>
                            <input required type="text" name="qty" class="form-input" value=<?php echo $qty?> >
                        </div>
                        <div class="form-group">
                            <div class="label">MRP</div>
                            <input required type="text" name="mrp" class="form-input" value=<?php echo $mrp?> >
                        </div>
                        <div class="form-group">
                            <div class="label">Price</div>
                            <input required type="text" name="price" class="form-input" value=<?php echo $price?> >
                        </div>
                        <div class="form-group">
                            <div class="label">Image</div>
                            <input required type="file" name="image" class="form-input" >
                        </div>
                        <div class="form-group">
                            <div class="label">Description</div>
                            <textarea name="description" value=<?php echo $description?> > </textarea>
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
