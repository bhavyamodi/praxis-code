<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");
$user=$_SESSION['inst_name'];
    $query = "select * from institution where inst_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    // print_r($row);
    $id = $row['inst_id'];

if(isset($_POST['submit'])){
$name = $_POST['name'];
$subid = $_POST['subid'];

$query_insert = " insert into subject (subject_name,class_id, inst_id) values ('$name','$subid','$id')";

$run = mysqli_query($connection, $query_insert);
if($run){
  $last_id = mysqli_insert_id($connection);
  $query12 = "SELECT * FROM teacher WHERE inst_id= $id";
$run12 = mysqli_query($connection,$query12);
$res12 = mysqli_fetch_array($run12);
$teacher_id = $res12['teacher_id'];
$insert = " insert into class_teacher (subject_id, class_id, teacher_id) values ('$last_id', '$subid','$teacher_id')";
mysqli_query($connection, $insert);  
 ?>
?>
 <script type="text/javascript">
alert("Subject added successfully");
location="subject.php";
</script>
<?php
}
else{
  ?>
 <script type="text/javascript">
alert("subject cannot be added right now. Please try again later!");
location="subject.php";
</script>
<?php
//die("Connection failed: " . mysqli_error($connection));
}
}

?>

<div class="container">
  <button type="button" class="btn btn-outline-primary btn-icon-text">
        <i class="mdi mdi-upload btn-icon-prepend"></i>
        <a href="#modalLoginForm" class="smoothScroll" data-toggle="modal" data-target="#modalLoginForm">
          <span>Add Subject</span>
        </a>
    </button><br>
  <div class="row">
    <?php 

    $query = "SELECT * FROM subject WHERE inst_id = $id";
    $query_run = mysqli_query($connection, $query);
    $check_course = mysqli_num_rows($query_run)>0;
    if($check_course){
      while($row = mysqli_fetch_array($query_run)){
         $topic_id = $row['class_id'];
        $topic = "SELECT * FROM class where class_id = $topic_id ";
         $topic_run = mysqli_query($connection, $topic);
        ?>
      <div class="col-md-3">
      <div class="card text-center p-3 my-3">
        <h4 clas="card-title">
          <?php foreach($topic_run as $topic_row){ echo $topic_row['class_name'];} ?></h4>
        <p class="card-text">
                 <?php echo $row['subject_name']; ?>          
        </p>
        <div class="row">
          <div class="col-md-4">
        <button type="button" class="btn btn-inverse-primary btn-icon">
                    <a href="assignteacher.php?id=<?php echo $row['subject_id']; ?>" class="text-white" data-toggle="tooltip" title="Assign Teacher"> <i class="mdi mdi-account-plus"></i></a>
                </button>
            </div>
           <div class="col-md-4">
               <button type="button" class="btn btn-inverse-success btn-icon">
                    <a href="viewsubject.php?id=<?php echo $row['subject_id']; ?>" class="text-white"  data-toggle="tooltip" title="View assigned teacher"> <i class="mdi mdi-view-headline"></i></a>
                </button> 
            </div>
            <div class="col-md-4">
        <button type="button" class="btn btn-inverse-danger btn-icon">
                    <a href="deletesubject.php?id=<?php echo $row['subject_id']; ?>" class="text-white"  data-toggle="tooltip" title="Delete Class"> <i class="mdi mdi-delete-sweep"></i></a>
                </button>
            </div>
        </div>
      
        
      </div>
      
    </div>
    <?php
      }
    }

    ?>
    
    
  </div>
  
</div>
<!-- add course modal -->
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title w-100 font-weight-bold">Add Subject</h4>
        
      </div>
      <div class="modal-body mx-3">
       
    <form action="" method="post" class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="mb-4">
                      <label data-error="wrong" data-success="right">Topic Name</label>
                      <select class="form-control text-white" name="subid">
                           <?php
                              $rs=mysqli_query($connection,"Select * from class where inst_id = '$id' ");
                                  while($row=mysqli_fetch_array($rs))
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
                                  ?>
                      </select>
                      </div>
        <div class="mb-4">
          <i class="fa fa-envelope prefix grey-text"></i>
          <label data-error="wrong" data-success="right">Subject Name</label>
          <input type="text" name="name" class="form-control text-white" required>
        </div>
        <br>
        <div class="mb-4">
            <input type="submit" name="submit" class="form-control btn btn-primary" value="SUBMIT">
                  </div>
    </form>

     
    </div>
  </div>
</div>
</div>
<?php 
include("includes/footer.php");
include("includes/scripts.php");

?>