<?php
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){

}
else{
   header('location:login.php');
}
$user_id=$_SESSION['User_id'];
if(isset($_POST['submit'])){
  $name=mysqli_real_escape_string($conn,$_POST['name']);
  $mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
  $pincode=mysqli_real_escape_string($conn,$_POST['pincode']);
  $city=mysqli_real_escape_string($conn,$_POST['city']);
  $state=mysqli_real_escape_string($conn,$_POST['state']);
  $local_address=mysqli_real_escape_string($conn,$_POST['local_address']);
  $town=mysqli_real_escape_string($conn,$_POST['town']);
  $sql="insert into addresses(name,mobile,pincode,city,state,local_address,town,user_id) values('$name','$mobile','$pincode','$city','$state','$local_address','$town','$user_id')";
  mysqli_query($conn,$sql);
  header('location:place_order.php');
}
?>

<?php 
 require('header.inc.php');
 ?>
          <div class="change-address">
                  
                <form method="post">
                    <section>
                      <fieldset>
                         <legend>Contact Details</legend>
                         <input required type="text" name="name" placeholder="Name*">
                         <input required type="tel" name="mobile" placeholder="Mobile*">
                      </fieldset>
                      <fieldset>
                        <legend>Address Details</legend>
                        
                        <input type="text" name="pincode" placeholder="Pin Code*" required>
                        <input type="text" name="local_address" placeholder="Address(House NO,Building,Street,Area)*" required>
                        <input type="text" name="town" placeholder="Locality/Town*" required>
                        <input type="text" name="city" placeholder="City*" required>
                        <input type="text" name="state" placeholder="State*" required>
                      </fieldset>
                      <button type="submit" name="submit">Add Address</button>
                    </section>
                </form>
          </div>
<?php
require('footer.inc.php') ;
?>    