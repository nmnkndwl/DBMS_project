<?php
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){

}
else{
   header('location:index.php');
}
$user_id=$_SESSION['User_id'];
$sql="select * from users where id='$user_id'";
$user=mysqli_fetch_assoc(mysqli_query($conn,$sql));


if(isset($_POST['delete'])){
    mysqli_query($conn,"delete from users where id='$user_id'");
    header('location:logout.php');
}
?>


<?php 
 require('header.inc.php');
 ?>
          <div class="my-account-page">
            <div class="account-details">
                    <div class="registered-email">
                    <?php 
                        echo "Registered Email: ".$user['email'];
                    ?>
                    </div>
                    <div class="registered-mobile">
                    <?php 
                        if($user['mobile']!=""){
                            echo "Registered Mobile: ".$user['mobile'];?>
                            <a href="update_mobile.php">update</a>
                        <?php }
                        else{?>
                            <a href="update_mobile.php">Register Mobile</a>
                    <?php }
                    ?>
                    </div>
                    <div class="delete-account">
                    <button onclick="displayconfirm()">Delete Account</button>
                        <form method="post">
                            <button type="submit" name="delete" id="confirm" class="confirm-delete">Confirm to Delete</button>
                        </form>
                    </div>
            </div>
          </div>
<?php
require('footer.inc.php') ;
?>    

<script>
 function displayconfirm() {
   var element = document.getElementById("confirm");
            
            if (!element.classList.contains("show-confirm")) {
                element.classList.add("show-confirm");
            }
            else{
               element.classList.remove("show-confirm");
            }
 }
</script>