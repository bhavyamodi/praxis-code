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

    <div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3"> 
  </div>
<div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Topic name </th>
            <th>Video</th>
            <th>Upload Date</th>
          </tr>
        </thead>
        <tbody>
     
          <?php  
                              $select_query3 = "select * from teacher_video where class_id = '$class_id' ";
                              $select_query3_run =  mysqli_query($connection, $select_query3);
                              $num = mysqli_num_rows($select_query3_run);
                             while($resu = mysqli_fetch_array($select_query3_run))
                              {   
                              ?>
                              <tr>
                  
                                <td><?php echo $resu['video_topic']; ?>  </td>
                               <td> <button type="submit" name="update_btn" class="btn btn-info"><a href="video.php?id=<?php echo $resu['video_id']; ?>" class="text-white">View</a></button></td>
                                <td><?php echo date('F d, Y', strtotime($resu['video_date'])); ?></td>
                                
                             
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

<?php 
include("includes/footer.php");
include("includes/scripts.php");

?>