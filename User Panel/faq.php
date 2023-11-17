<?php
require('connection.inc.php');

$queries=mysqli_query($conn,"select * from queries");
?>

<?php 
 require('header.inc.php');
 ?>
          <div class="faq">
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
<?php
require('footer.inc.php') ;
?>