<?php
include("security2.php");
include('includes/header.php'); 
include('includes/studnav.php'); 
$user=$_SESSION['student_name'];
    $query = "select * from student where student_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    // print_r($row);
    $id = $row['class_id'];

?>

<div class="container-fluid col-8">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  	 <h3 class="text-white text-center">Exam List 
            
    </h3>
  </div>
 <div class="col-6" style="margin: 0px; padding:0px; margin-bottom: 50px;">

        

            <?php
             $rs=mysqli_query($connection,"select * from mst_test where class_id = $id");
             while($res=mysqli_fetch_array($rs))
            {
             $sub = $res['test_bank_id'];
            $query=mysqli_query($connection,"SELECT * FROM test_bank where test_id ='$sub' ");
            while($row=mysqli_fetch_array($query))
            {
                ?>
            <input type="button" class="btn btn-success form-control" value="<?php echo $row["test_name"]; ?>" style="margin-top: 10px; background-color: blue; color: white" onclick="set_exam_type_session(this.value);">
                <?php

            }
          }
            ?>


        </div>
  <center><button type="button" class="btn btn-outline-success" data-toggle="tab" href="#select">Start Quiz</button>
  <br>
  <div class="col-6">
      
 <div class="tab-pane fade text-center p-2" id="select" >
  <br>
  <form action="quiz.php" method="post">
                      <select class="form-control text-white" name="id">
                           <?php
                              $rs=mysqli_query($connection,"select * from mst_test where class_id = $id");
                              while($res=mysqli_fetch_array($rs))
                              {
                              $sub = $res['test_bank_id'];
                               $query=mysqli_query($connection,"SELECT * FROM test_bank where test_id ='$sub' ");
                                  while($row=mysqli_fetch_array($query))
                                  {
                                  if($row[0]==$subid)
                                  {
                                  echo "<option value='$row[0]' selected>$row[1]</option>";
                                  }
                                  else
                                  {
                                  echo "<option value='$row[0]'>$row[1]</option>";
                                  }
                                  }
                                }
                                  ?>
                      </select><br>
                      <input type="submit" name="submit" class="btn btn-primary" value="Select">
                       </form>
                    </div>
                 
                      </div>
                      </center>
        </div>             
</div>
<script type="text/javascript">
    function set_exam_type_session(test_id)
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                window.location = "test_page.php";
            }
        };
        xmlhttp.open("GET","forajax/set_exam_type_session.php?test_id="+ test_id,true);
        xmlhttp.send(null);
    }
</script>

 <?php
include('includes/scripts.php');
include('includes/footer.php');
?>

