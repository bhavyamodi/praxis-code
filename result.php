<?php
include("security2.php");
$date = date("Y-m-d H:i:s");
$_SESSION["end-time"]=date("Y-m-d H:i:s", strtotime($date."+ $_SESSION[exam_time] minutes"));
extract($_POST);
extract($_SESSION);

error_reporting(1);
include('includes/header.php'); 
include('includes/studnav.php'); 
$user=$_SESSION['student_name'];
    $query = "select * from student where student_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    $id = $row["student_id"];

    $value = $_SESSION["answer"][$question_no];

   // $today = date("Y-m-d H:i:s"); 
   // echo $today;
?>
<div class="container-fluid col-6">

    <?php
    $correct = 0 ;
    $wrong = 0;
    $not = 0;
    if(isset($_SESSION["answer"])){
      for($i=1;$i<=sizeof($_SESSION["answer"]);$i++){
        $answer="";
        $res=mysqli_query($connection,"SELECT * from mst_question where test_id='$_SESSION[test_id]' && question_no=$i ");
        while($row=mysqli_fetch_array($res)){
          $answer=$row["answer"];
        }
        if(isset($_SESSION["answer"][$i])){
          if($answer==$_SESSION["answer"][$i]){
          $correct=$correct+1;
            }
            else{
          $wrong=$wrong+1;
            }
          }
          else{
              $not = $not+1;
          }
        }
    }
    $count = 0;
    $res=mysqli_query($connection,"SELECT * from mst_question where test_id='$_SESSION[test_id]'");
    $count=mysqli_num_rows($res);
  //  $wrong=$count-$correct;
$not = $count - $correct - $wrong;
    ?>



<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-white text-center">
      <span class="mdi mdi-book-open-page-variant icon-item text-warning"></span>
      &nbsp;
      Your Result    
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">
      <?php
    echo "<center>";
    echo "<span class='mdi mdi-comment-plus-outline text-info'></span> &nbsp;Total Questions = ".$count;
    echo "<br>";
    echo "<span class='mdi mdi-comment-check-outline text-primary'></span> &nbsp;Correct Answer = ".$correct;
    echo "<br>";
    echo "<span class='mdi mdi-comment-alert-outline text-danger'></span> &nbsp;Wrong Answer = ".$wrong;
    echo "<br>";
    echo "<span class='mdi mdi-comment-account-outline text-success'></span> &nbsp;Your Score = ".$correct;
    echo "<br>";
    echo "<span class='mdi mdi-account-alert text-warning'></span> &nbsp;Not Answer = ".$not;
    echo "</center>"
    ?>
    
  </div>
</div>
</div>

</div>
<div class="row">
  <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h5 class="mb-0">
                            <?php
                            $result = mysqli_query($connection,"SELECT MIN(student_score) AS minimum FROM mst_result WHERE test_id= '$_SESSION[test_id]' ");
    $row = mysqli_fetch_assoc($result); 

         $minimum = $row['minimum'];
    echo "Minimum marks of class";
    ?>
                          </h5>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger ">
                          <span class="mdi mdi-priority-low icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-white font-weight-normal"><?php echo $minimum; ?></h6>
                  </div>
                </div>
              </div>
  <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h5 class="mb-0">
                            <?php
                           $result2 = mysqli_query($connection,"SELECT AVG(student_score) AS average FROM mst_result WHERE test_id= '$_SESSION[test_id]' ");
    $row2 = mysqli_fetch_assoc($result2); 

         $average = $row2['average'];
    echo "Average score of class";
    ?>
                          </h5>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-primary ">
                          <span class="mdi mdi-format-align-middle icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-white font-weight-normal"><?php echo $average; ?></h6>
                  </div>
                </div>
              </div>
    <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h5 class="mb-0">
                            <?php
                          $result1 = mysqli_query($connection,"SELECT MAX(student_score) AS maximum FROM mst_result WHERE test_id= '$_SESSION[test_id]' ");
    $row1 = mysqli_fetch_assoc($result1); 

         $maximum = $row1['maximum'];
    echo "Maximum marks of class";
    ?>
                          </h5>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-priority-high icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-white font-weight-normal"><?php echo $maximum; ?></h6>
                  </div>
                </div>
              </div>
</div>

<div class="container-fluid col-12">
<div id="result">
  
</div>
<script>
// Check browser support
for (i = 0; i < localStorage.length; i++){
     var key = localStorage.key(i);
     var value = localStorage.getItem(key); 


 document.getElementById("result").innerHTML = localStorage.getItem(key)  + "<br>" ;

    }
</script>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h3 class="text-white text-center">Solutions: 
            
    </h3>
  </div>
  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-borderless">
                        <thead>
                          <?php
                          
                          $query1 = mysqli_query($connection , "SELECT * FROM mst_question where test_id= '$_SESSION[test_id]'");
                           
                            while($row1=mysqli_fetch_array($query1)) {
                              $tid = $row1["test_id"];
                              $qno = $row1["question_no"];
                              $query = mysqli_query($connection, "SELECT * FROM mst_answer WHERE test_id = '$tid' && question_no ='$qno' && student_id='$id' ");
                                $res=mysqli_fetch_array($query)
                                
                              ?>

                          <tr>
                            <th>Question No. <?php echo $row1['question_no']; ?>&emsp;<?php echo wordwrap($row1['question'],100,"<br>\n"); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="text-white">
                                <td>Your Answer:&nbsp;
                                  <?php 
                                   $k = $res['student_answer'];
                                   if($k=="1"){
                                    echo $row1['option_1'];
                                   }
                                   elseif($k=="2"){
                                    echo $row1['option_2'];
                                   }
                                   elseif ($k=="3"){
                                    echo $row1['option_3'];
                                   }
                                   elseif($k=="4"){
                                    echo $row1['option_4'];
                                   }

                                   ?></td>
                            </tr>                            
                            <tr>
                                <td>Correct Answer: &nbsp;
                                  <?php 
                                   $key = $row1['answer'];
                                   if($key=="1"){
                                    echo $row1['option_1'];
                                   }
                                   elseif($key=="2"){
                                    echo $row1['option_2'];
                                   }
                                   elseif ($key=="3"){
                                    echo $row1['option_3'];
                                   }
                                   elseif($key=="4"){
                                    echo $row1['option_4'];
                                   }

                                   ?></td>
                            </tr>
             
                            <tr>
                                <td class="bg-dark">Solution. <?php echo $row1['solution']; ?></td>

                            </tr>
                 <?php
                 
              }          ?>
                        </tbody>

                      </table>
                  </div>
              </div>
          </div>
        </div>
<?php
if(isset($_SESSION["exam_start"])){
  $date = date("Y-m-d");
  $qu = mysqli_query($connection,"SELECT * FROM mst_result where test_id=$_SESSION[test_id] && student_id=$id");
  $c =mysqli_num_rows($qu);
  if($c==0)
  {

  mysqli_query($connection,"INSERT INTO mst_result (student_id,student_score, test_id, total_question, correct_answer, wrong_answer,not_answer, exam_time) VALUES ('$id','$correct','$_SESSION[test_id]','$count','$correct','$wrong','$not','$date')");
  for($i=1;$i<=sizeof($_SESSION["answer"]);$i++){
    if(isset($_SESSION["answer"][$i])){
      $ans = $_SESSION["answer"][$i];

    $sql = mysqli_query($connection,"INSERT INTO mst_answer (`student_id`, `test_id`,`question_no`, `student_answer`) VALUES('$id','$_SESSION[test_id]','$i','$ans')");
    }

   }
  }
  else{
    ?>
     <script>
     alert("You have already given this test !!");
     location="studentresult.php";
    </script>
    <?php
  }
}
if(isset($_SESSION["exam_start"])){
  unset($_SESSION["exam_start"]);
  ?>
  <script type="text/javascript">
    window.location.href=window.location.href;
  </script>
  <?php
}
?>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
