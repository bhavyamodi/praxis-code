<?php 
include("security1.php");
include("includes/header.php");
include("includes/teachernav.php");
$id = $_GET['id'];

?>

<!-- DataTales Example -->
<div class="card">
  <div class="card-header p-3">
    <h6 class="m-0 text-white">Student Details
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
             <th>Student name </th>
             <th>Class</th>
            <th>student email</th>
            <th>Student mobile </th>
            <th>Student Address</th>
            <th>Delete Student</th>
          </tr>
        </thead>
        <tbody>
     
          <?php  
                              $query = "SELECT * FROM student WHERE class_id = $id";
                              $query_run = mysqli_query($connection, $query);
                             while($resu = mysqli_fetch_array($query_run))
                              {  

                              $topic_id = $resu['class_id'];
                              $topic1 = "SELECT * FROM class where class_id = $topic_id ";
                              $topic1_run = mysqli_query($connection, $topic1);
                              
                              ?>
                              <tr>
                                 <td><?php echo $resu['student_name']; ?></td>
                                <td><?php foreach($topic1_run as $topic_row){ echo $topic_row['class_name'];}?></td>
                                <td> echo $resu['student_email']; ?></td>
                                <td><?php echo $resu['student_contact'];?></td>
                                <td><?php echo $resu['student_address'];?></td>
                                <td> <button type="submit" name="delete_btn" class="btn btn-danger"><a href="deletestudent.php?id=<?php foreach($topic_run as $topic_row){ echo $topic_row['student_id'];} ?>" class="text-white"> Delete</a></button>
                                </td>
                             
          </tr>
          <?php
                              }
                              ?>
        </tbody>
      </table>

    </div>
  </div>
</div>
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>