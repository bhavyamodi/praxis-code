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

?>

  <div class="row">
    <?php 

    $query = "SELECT * FROM class_teacher WHERE class_id = $class_id";
    $query_run = mysqli_query($connection, $query);
    $check_course = mysqli_num_rows($query_run)>0;
    if($check_course){
      while($row = mysqli_fetch_array($query_run)){
         $topic_id = $row['teacher_id'];
        $topic = "SELECT * FROM teacher where teacher_id = $topic_id ";
         $topic_run = mysqli_query($connection, $topic);
         $subject_id = $row['subject_id'];
        $subject = "SELECT * FROM subject where subject_id = $subject_id ";
         $subject_run = mysqli_query($connection, $subject);

        ?>
       <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card text-center my-3 p-3">

        <h4 clas="card-title">
           Subject Name 
        </h4>
        <p class="card-text">
            <button class="btn btn-outline-primary">
               <a href="viewsyllabus.php?id=<?php foreach($subject_run as $topic1_row){ echo $topic1_row['subject_id'];} ?>" class="text-primary"> <?php foreach($subject_run as $topic1_row){ echo $topic1_row['subject_name'];} ?> </a>  
               </button>       
        </p>
      </div>
      
    </div>
    <?php
      }
    }

    ?>
    
    
  </div>

<?php 
include("includes/footer.php");
include("includes/scripts.php");

?>