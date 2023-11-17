<?php
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){

}
else{
   header('location:login.php');
}
$user_id=$_SESSION['User_id'];
if(isset($_GET['address_id']) && $_GET['address_id']!=""){
    $address_id=$_GET['address_id'];

  $sql="select * from addresses where id='$address_id'";
  $address=mysqli_fetch_assoc(mysqli_query($conn,$sql));

  $name=$address['name'];
  $mobile=$address['mobile'];
  $pincode=$address['pincode'];
  $city=$address['city'];
  $state=$address['state'];
  $local_address=$address['local_address'];
  $town=$address['town'];
}
if(isset($_POST['submit'])){
  $name=mysqli_real_escape_string($conn,$_POST['name']);
  $mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
  $pincode=mysqli_real_escape_string($conn,$_POST['pincode']);
  $city=mysqli_real_escape_string($conn,$_POST['city']);
  $state=mysqli_real_escape_string($conn,$_POST['state']);
  $local_address=mysqli_real_escape_string($conn,$_POST['local_address']);
  $town=mysqli_real_escape_string($conn,$_POST['town']);
  $sql="update  addresses set name='$name',mobile='$mobile',pincode='$pincode',city='$city',state='$state',local_address='$local_address',town='$town' where id='$address_id'";
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
                         <input required type="text" name="name" placeholder="Name*" value="<?php echo $name?>">
                         <input required type="tel" name="mobile" placeholder="Mobile*" value="<?php echo $mobile?>">
                      </fieldset>
                      <fieldset>
                        <legend>Address Details</legend>
                        
                        <input type="text" name="pincode" placeholder="Pin Code*" required value="<?php echo $pincode?>">
                        <input type="text" name="local_address" placeholder="Address(House NO,Building,Street,Area)*" required value="<?php echo $local_address?>">
                        <input type="text" name="town" placeholder="Locality/Town*" required value="<?php echo $town?>">
                        <input type="text" name="city" placeholder="City*" required value="<?php echo $city?>">
                        <input type="text" name="state" placeholder="State*" required value="<?php echo $state?>">
                      </fieldset>
                      <button type="submit" name="submit">Update Address</button>
                    </section>
                </form>
          </div>
<?php
require('footer.inc.php') ;
?>    