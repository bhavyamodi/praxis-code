<?php 
include("security1.php");
include("includes/header.php");
include("includes/teachernav.php");

$user=$_SESSION['teacher_name'];
    $query = "select * from teacher where teacher_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    // print_r($row);
    $teacher_id = $row['teacher_id'];

    $query1 = "select * from class_teacher where teacher_id = '$teacher_id' ";
    $run_query1 = mysqli_query($connection, $query1);
    $row1 = mysqli_fetch_array($run_query1);
    // print_r($row);
    $class_id = $row1['class_id'];

    if(isset($_POST['coursebtn']))
    {
    $query_topic = $_POST['topic'];

   
            $query = "INSERT INTO `instructor_test_request`(`teacher_id`, `request_msg`,`request_date`) VALUES ('$teacher_id','$query_topic',now())";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
          
              echo "<script>alert('Question asked succesfully')</script>";
            }
            else 
            {
                
                 echo "<script>alert('some error occured! please try again after some time')</script>";
            
            }
        
    }


?>
<div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">
                     <h6 class="m-0 font-weight-bold text-white">Tests:
            <button class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#addadminprofile">
              Request Test
            </button>
    </h6>
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                            <th>Test Name</th>
                            <th>Schedule Date</th>
                            <th>View Test</th>
                            <th>Modify Test</th>
                            <th>Assign Test</th>
                            <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                             <?php  
                              $select_query = "select * from mst_test where teacher_id = '$teacher_id' ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              { 

                              $test_id = $res['test_bank_id'];
                              $course1 = "SELECT * FROM test_bank where test_id = $test_id ";
                              $run = mysqli_query($connection, $course1);
                             
                              ?>
                              <tr>
                                <td><?php foreach($run as $course1_row){ echo $course1_row['test_name'];} ?></td>
                                <td><?php echo date('F d, Y', strtotime($res['schedule_date'])); ?></td>
                                 <td>
                                    <button type="button" class="btn btn-success">
                                    <a href="viewtestquestion.php?id=<?php echo $res['test_id']; ?>" class="text-white">View Test</a>
                                    </button>
                                </td>
                                 <td>
                                    <button type="button" class="btn btn-info">
                                    <a href="edittestquestion.php?id=<?php echo $res['test_id']; ?>" class="text-white">Edit Test</a>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary">
                                    <a href="assigntest.php?id=<?php echo $res['test_id']; ?>" class="text-white">Assign Test</a>
                                    </button>
                                </td>
                                
                                <td><?php echo $res['status']; ?></td>
                               
                              <?php } ?>
                              </tr>
                          </tbody>
                        </table>
                    </div>
                  </div>
            </div>
        </div>
 </div>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Test</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label>Your Request ? </label>
                <input type="text" name="topic" class="form-control" placeholder="Enter your question.." required>
            </div>  
       </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="coursebtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>