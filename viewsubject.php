<?php
include('security.php');
$ids = $_GET['id'];
include('includes/header.php'); 
include('includes/navbar.php'); 
$user=$_SESSION['inst_name'];
    $query = "select * from institution where inst_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    // print_r($row);
    $id = $row['inst_id'];

    $query1 = "SELECT * FROM subject WHERE subject_id = $ids";
    $query1_run = mysqli_query($connection, $query1);
    $row1 = mysqli_fetch_array($query1_run);
    $class_id = $row1['class_id'];
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Class Name </th>
            <th>Subject </th>
            <th>Teacher</th> 
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
     
          <?php 

    $query = "SELECT * FROM class_teacher WHERE subject_id = $ids";
    $query_run = mysqli_query($connection, $query);
    $check_course = mysqli_num_rows($query_run)>0;
      while($row = mysqli_fetch_array($query_run)){
         $topic_id = $row['class_id'];
         $topic_id1 = $row['teacher_id'];
        $topic = "SELECT * FROM class where class_id = $topic_id ";
         $topic_run = mysqli_query($connection, $topic);
         $topic1 = "SELECT * FROM subject where subject_id = $ids ";
         $topic1_run = mysqli_query($connection, $topic1);
         $topic2 = "SELECT * FROM teacher where teacher_id = $topic_id1 ";
         $topic2_run = mysqli_query($connection, $topic2);
        ?>
                              <tr>
                                <td><?php foreach($topic_run as $topic_row){ echo $topic_row['class_name'];} ?></td>
                                <td><?php foreach($topic1_run as $topic1_row){ echo $topic1_row['subject_name'];} ?></td>
                                <td><?php foreach($topic2_run as $topic2_row){ echo $topic2_row['teacher_name'];} ?></td>
                                <td> <button type="button" class="btn btn-inverse-danger">
                    <a href="removeteacher.php?id=<?php echo $row['class_teacher_id']; ?>" class="text-white"  data-toggle="tooltip" title="Remove Teacher"> <i class="mdi mdi-delete-sweep"></i></a>
                </button></td>
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
include('includes/scripts.php');
include('includes/footer.php');
?>