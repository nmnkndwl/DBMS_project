<?php
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){

}
else{
   header('location:login.php');
}
?>

<?php 
 require('header.inc.php');
 ?>
          <div class="main">
            <h1>Thank you! Your Order is placed Successfully</h1>
          </div>
<?php
require('footer.inc.php') ;
?> 