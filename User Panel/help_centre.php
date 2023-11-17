<?php
require('connection.inc.php');
if(isset($_SESSION['User_login']) && $_SESSION['User_login']!=""){

}
else{
   header('location:index.php');
}
$user_id=$_SESSION['User_id'];

$queries=mysqli_query($conn,"select * from queries where user_id='$user_id'");
if(isset($_POST['submit'])){
  $query=mysqli_real_escape_string($conn,$_POST['query']);
  $mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
  $name=$_SESSION['User_name'];
  $email=$_SESSION['User_email'];
  $sql="insert into queries (query,name,mobile,email,user_id) values ('$query','$name','$mobile','$email','$user_id')";
  mysqli_query($conn,$sql);
  header('location:index.php');
}
?>


<?php 
 require('header.inc.php');
 ?>
          <div class="query">
                    <div class="query-form">
                      <h1>Query form</h1>
                            <form method="post">
                              
                                <div class="form-group">
                                    <div class="label">Query</div>
                                    <input required type="text" name="query" class="form-input" >
                                </div>
                                <div class="form-group">
                                    <div class="label">Mobile</div>
                                    <input required type="tel" name="mobile" class="form-input"  >
                                </div>
                                
                                  <button type="submit" name="submit" class="submit form-input">Submit</button>
                            </form>
                    </div>
                    <div class="my-queries">
                       <?php
                         while($row=mysqli_fetch_assoc($queries)){?>
                         <div class="query-box">
                            <div class="question">
                                <h2><?php echo "Query : ".$row['query']?></h2>
                              </div>
                              <div class="answer">
                                <?php
                                  if($row['ans']!=""){?>
                                    <h2><?php echo "Answer  : ".$row['ans']?></h2>
                                <?php }
                                else{?>
                                  <h2><?php echo "Answer  : "."Not Answered Yet..."?></h2>
                                <?php }
                                ?>
                              </div>
                         </div>
                          
                        <?php }
                       ?>
                     
                    </div>
          </div>
<?php
require('footer.inc.php') ;
?>    