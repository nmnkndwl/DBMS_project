<?php
if(isset($_POST['search']) && $_POST['search_this']!=""){
  $search=mysqli_real_escape_string($conn,$_POST['search_this']);
  $location="location:search_results.php?search=$search";
  header($location);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Online Market Shopping</title>
</head>
<body>
   <div class="app">
    <div class="fixing">
          <div class="header">
              <div class="logo">
                    <img src="./images/logo1.jpg" alt="logo">
              </div>
              <div class="log-details">
                <?php
                   if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){
                    echo "<h1> Welcome ".$_SESSION['User_name']."&nbsp;&nbsp;</h1>";
                   }
                   else{
                  ?>
                     <a href="login.php">Login</a>
                <?php
                  }
                ?>
                
                    <a href="user_cart.php"><i class="fa fa-shopping-cart fa-1x"></i></a>
              </div>
              <div class="searchbar">
                <form method="post">
                   <input type="text" placeholder="" name="search_this">
                   <button type="submit" name="search">search</button>
                </form>
              </div>
          </div>
          <div class="navbar">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="mens.php">Mens</a></li>
                <li><a href="womens.php">Womens</a></li>
                <li><a href="children.php">Children</a></li>
                <li><a href="electronics.php">Electronics</a></li>
                <li><a href="household.php">Household</a></li>
                <li><a href="#footer">About Us</a></li>
                <li><a href="faq.php">FAQ</a></li>
              </ul>
              <div class="account">
                <?php
                   if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){
                      ?>
                      <div class="dropdown">
                         <i class="fa-solid fa-circle-user fa-4x"></i>
                        <div class="dropdown-content">
                              <a href="my_account.php">My Account</a>
                              <a href="my_orders.php">My Orders</a>
                              <a href="help_centre.php">Help Centre</a>
                              <a href="logout.php">logout</a>
                          </div>
                      </div>
                     
                  <?php }
                   else{
                     echo "<h2><a href="."'login.php'".">Guest Login</a></h2>";
                   }
                    
                ?>
                 
              </div>
          </div>
    </div>
      