<?php
  require('connection.inc.php');
  $msg="";
  if(isset($_POST['submit'])){
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $sql="select * from admin_users where username='$username' and password='$password'";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if($count>0){
        $_SESSION['Admin_login']='yes';
        $_SESSION['Admin_name']=$username;
        header('location:categories.php');
    }
    else{
        $msg="Please enter correct login details";
    }
  }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body >
<div class="join-container">
    <h1>Login Admin</h1>
      <form method="post">
               <div class="join-username">
                     <input required id="username" placeholder='username...'   type="text" name="username" />
               </div> 
               <div class="join-username">
                     <input required placeholder='password..'  type="password" name="password" />
               </div>
               
                <div class="join-button">
                <button type="submit" name="submit"><b>Login</b></button>
                </div>   
               
           
      </form>
      <div class="errormsg">
        <?php
        echo $msg;
        ?>
      </div>
</div>
               
</body>
</html>