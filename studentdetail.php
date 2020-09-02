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


    ?>
 <div class="col-xl-12 col-sm-6 grid-margin stretch-card">
    <?php 

    $query = "SELECT * FROM class_teacher WHERE teacher_id = $teacher_id";
    $query_run = mysqli_query($connection, $query);
    $check_course = mysqli_num_rows($query_run)>0;
    if($check_course){
      while($row = mysqli_fetch_array($query_run)){
         $topic_id = $row['class_id'];
        $topic = "SELECT * FROM class where class_id = $topic_id ";
         $topic_run = mysqli_query($connection, $topic);
         $subject_id = $row['subject_id'];
        $subject = "SELECT * FROM subject where subject_id = $subject_id ";
         $subject_run = mysqli_query($connection, $subject);

        ?>
       <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card text-center my-3 p-3">

        <h4 clas="card-title">
           <?php foreach($topic_run as $topic_row){ echo $topic_row['class_name'];} ?> 
        </h4>
        <p class="card-text">
          <button class="btn btn-outline-primary"><a href="viewclassstudent.php?id= <?php foreach($topic_run as $topic_row){ echo $topic_row['class_id'];} ?>">
                <?php foreach($subject_run as $topic1_row){ echo $topic1_row['subject_name'];} ?> 
                </a></button>         
        </p>
      </div>
      
    </div>
    <?php
      }
    }
    ?>    
  </div>


<!-- /.container-fluid -->

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>