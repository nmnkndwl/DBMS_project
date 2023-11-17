<?php
  require('connection.inc.php');
  $msg="";
  if(isset($_POST['submit'])){
    $useremail=mysqli_real_escape_string($conn,$_POST['useremail']);

    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    
    $confirmpassword=mysqli_real_escape_string($conn,$_POST['confirmpassword']);
    if(filter_var($useremail,FILTER_VALIDATE_EMAIL)){
      if($password!="" && $password==$confirmpassword){
        $check=mysqli_num_rows(mysqli_query($conn,"select * from users where email='$useremail'"));
        if($check==0){
          $hash=password_hash($password,PASSWORD_DEFAULT);
           $sql="insert into users (email,name,password) values('$useremail','$username','$hash')";
           mysqli_query($conn,$sql);
           header('location:login.php');
        }
        else{
         $msg="email already registered";
        }
       
      }
      else{
         $msg="Please enter valid details";
       }
    }
    else{
      $msg="please enter valid email";
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
    <style>
        body{
            
                background-image: url("./images/login1.jpg");
                background-repeat: no-repeat;
                background-size:cover;
            }
    </style>
</head>
<body>
<div class="join-container">
               <h1>Register User</h1>
               <form method="post">
                        <div class="join-username">
                              <input required  id="myemail" placeholder='Email...'   type="email" name="useremail" />
                        </div> 
                        <div class="join-username">
                              <input required placeholder='username...'   type="text" name="username" />
                        </div> 
                        <div class="join-username">
                              <input required placeholder='password..'  type="password" name="password" />
                        </div>
                        <div class="join-username">
                              <input required placeholder='confirm password..'   type="password" name="confirmpassword" />
                        </div> 
                        <div class="join-button">
                        <button type="submit" name="submit">Create User</button>
                        </div>  
               </form>
                
                <div class="already">
                    <span>Already an Existing User? <a href="login.php">Login</a></span>
                </div>
                <div class="errormsg">
                  <?php
                  echo $msg;
                  ?>
                </div>

        </div>
</body>
</html>