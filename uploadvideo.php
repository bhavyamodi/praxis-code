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

if(isset($_POST['submit'])){
    $topic = $_POST['topic'];
    $name = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    
    move_uploaded_file($temp, "files/".$name);

    $query = "INSERT INTO teacher_video (teacher_id,class_id, video_topic, video_file, video_date) VALUES('$teacher_id','$class_id', '$topic', '$name', now())";
    if(mysqli_query($connection,$query)){
        echo "video uploaded successfully";
    }
    else{
        echo "error:". mysqli_error($connection);
    }
}
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3"> 
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addadminprofile">
              Upload Video 
            </button>
  </div>
<div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Topic name </th>
            <th>Video</th>
            <th>Upload Date</th>
            <th>Delete</th>

          </tr>
        </thead>
        <tbody>
     
          <?php  
                              $select_query3 = "select * from teacher_video where teacher_id = '$teacher_id' ";
                              $select_query3_run =  mysqli_query($connection, $select_query3);
                              $num = mysqli_num_rows($select_query3_run);
                             while($resu = mysqli_fetch_array($select_query3_run))
                              {   
                              ?>
                              <tr>
                  
                                <td><?php echo $resu['video_topic']; ?>  </td>
                               <td> <button type="submit" name="update_btn" class="btn btn-info"><a href="video.php?id=<?php echo $resu['video_id']; ?>" class="text-white">View</a></button></td>
                                <td><?php echo date('F d, Y', strtotime($resu['video_date'])); ?></td>

                                <td> <button type="submit" name="update_btn" class="btn btn-danger"><a href="deletevideo.php?id=<?php echo $resu['video_id']; ?>" class="text-white">Delete</a></button></td>
                                
                             
          </tr>
          <?php
                              }
                              ?>
        
        </tbody>
      </table>
  </div>
</div>

</div>

</div>

<!-- Add Student modal-->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="p-3">
   <form method="POST" enctype="multipart/form-data">
    <label class="text-white">Select File</label>
    <input type="file" name="file">
    <br><br>
    <label>Enter Topic Name</label>
    <input type="text" name="topic" required>
    <br>
    <br>
    <input type="submit" name="submit" class="btn btn-outline-primary float-right" value="upload video">
</form>
</div>
</div>
</div>
</div>
    <?php
include('includes/footer.php');
include('includes/scripts.php');
?>