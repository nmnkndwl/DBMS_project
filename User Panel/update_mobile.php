<?php
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){

}
else{
   header('location:index.php');
}
$user_id=$_SESSION['User_id'];

if(isset($_POST['submit']) && $_POST['mobile']!=""){
    $mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
    $sql="update users set mobile='$mobile' where id='$user_id'";
    mysqli_query($conn,$sql);
    header('location:my_account.php');
}
?>
<?php 
 require('header.inc.php');
 ?>
          <div class="update-mobile-page">
            <h2>Update Mobile No.</h2>
            <form method="post">
                <input type="text" name="mobile">
                <button type="submit" name="submit">Submit</button>
            </form>
          </div>
<?php
require('footer.inc.php') ;
?>   