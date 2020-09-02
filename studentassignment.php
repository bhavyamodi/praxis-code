<?php 
include("security2.php");
include("includes/header.php");
include("includes/studnav.php");

$user=$_SESSION['student_name'];
    $query = "select * from student where student_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    // print_r($row);
    $id = $row['inst_id'];
    $class_id = $row['class_id'];
    $query1 = "select * from institution where inst_id = '$id' ";
    $run_query1 = mysqli_query($connection, $query1);
    $row1 = mysqli_fetch_array($run_query1);
    $image = $row1['inst_image'];
    $inst_name = $row1['inst_name'];

     $query = "SELECT * FROM class_teacher WHERE class_id = $class_id";
    $query_run = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($query_run);
    $teacher_id = $row['teacher_id'];


if(isset($_POST['image'])){
    $filename = $_FILES["uploadfile"]["name"];
    $tempname= $_FILES["uploadfile"]["tmp_name"];
    $file = $_FILES["uploadfile"]['tmp_name'];
    $folder = "files/".$filename;
    move_uploaded_file($tempname, $folder);

    $topic = $_POST['topic'];
    $date = $_POST['date'];
          
              $insertquery = "Insert into assignment_student (`teacher_id`, `assignment_topic`, `assignment_file`, `assignment_submission`) values ('$teacher_id','$topic','$folder','$date') ";
              $run_query = mysqli_query($connection, $insertquery);
              if($run_query){
                ?>
                <script>
                  alert("Assignment uploaded");
                </script>
                <?php
              }else{
               die("Connection failed: " . mysqli_error($connection));
                ?>
                <script>
                  alert("Assignment cannot be uploaded");
                </script>
                <?php
              }
      }
?>

<div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">

                     <h6 class="card-title text-white">Assignments:
                      </h6>
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                            <th>Assignment Topic</th>
                            <th>Assignment File</th>
                            <th>Submit</th>
                            <th>Submission Date</th>
                            <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                             <?php  
                              $select_query = "select * from assignment where class_id = '$class_id' ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              { 
                             
                              ?>
                              <tr>
                                <td><?php echo $res['assignment_topic']; ?></td>
                                
                                 <td>
                                    <button type="button" class="btn btn-success">
                                    <a href="<?php echo $res['assignment_file']; ?>" class="text-white">View Assignment</a>
                                    </button>
                                </td>
                                 <td>
                                    <button type="button" class="btn btn-success">
                                    <a href="uploadassignment.php?id=<?php echo $res['assignment_id']; ?>" class="text-white">Submit Assignment</a>
                                    </button>
                                </td>
                                <td><?php echo date('F d, Y', strtotime($res['assignment_submission'])); ?></td>
                                <td>
                                  <?php echo $res['assignment_status']; ?>  
                                </td>                           
                              <?php } ?>
                              </tr>
                          </tbody>
                        </table>
                    </div>
                  </div>
            </div>
        </div>
 </div>
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>

