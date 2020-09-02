<?php 
include("security2.php");
include("includes/header.php");
include("includes/studnav.php");

$id = $_GET['id'];
$user=$_SESSION['student_name'];
    $query = "select * from student where student_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    // print_r($row);
    $class_id = $row['class_id'];
    $student_id = $row['student_id'];
  
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
          
              $insertquery = "Insert into assignment_student (`student_id`,`teacher_id`, `assignment_id`, `submit_file`, `submit_date`) values ('$student_id','$teacher_id','$id','$folder',now()) ";
              $run_query = mysqli_query($connection, $insertquery);
              if($run_query){
                ?>
                <script>
                  alert("Assignment submitted successfully");
                  location="studentassignment.php";
                </script>
                <?php
              }else{
               die("Connection failed: " . mysqli_error($connection));
                ?>
                <script>
                  alert("Assignment cannot be uploaded");
                  location="studentassignment.php";
                </script>
                <?php
              }
      }
?>



<form action="" method="POST" enctype="multipart/form-data">

                                      <div class="form-group">
                                           <input type="file" name="uploadfile" value="" />
                                      </div>  
                                         <input type="submit" name="image" value="Upload Assignment" class="btn btn-outline-primary">
                                     </form>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>