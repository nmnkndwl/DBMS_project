<?php
  require('connection.inc.php');
  $msg="";
  if(isset($_POST['submit'])){
    $useremail=mysqli_real_escape_string($conn,$_POST['useremail']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $sql="select * from users where email='$useremail'";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if($count>0){
        $row=mysqli_fetch_assoc($res);
        $hash=$row['password'];
        if(password_verify($password,$hash)){
            $_SESSION['User_login']='yes';
            $_SESSION['User_email']=$useremail;
            $_SESSION['User_name']=$row['name'];
            $_SESSION['User_id']=$row['id'];
    
            header('location:index.php');
        }
        else{
            $msg="Incorrect Password ";
        }
       
    }
    else{
        $msg="Please enter correct email ";
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
<body >
          <div class="join-container">
               <h1>Login User</h1>
               <form method="post">
                    <div class="join-username">
                            <input required id="myemail" placeholder='Email...'   type="email" name="useremail" />
                    </div> 
                    <div class="join-username">
                            <input required placeholder='password..'  type="password" name="password" />
                    </div>
                    
                    <div class="join-button">
                        <button type="submit" name="submit">Login</button>
                    </div>
               </form>
                 
                <div class="already">
                    <span>Don't have account? <a href="register.php">Register</a> </span>
                </div>
                <div class="errormsg">
                  <?php
                  echo $msg;
                  ?>
                </div>
            </div>
</body>
</html>