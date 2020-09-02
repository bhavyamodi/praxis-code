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

?>
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Student Queries
            
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Student </th>
            <th>Doubt</th>
            <th>Your response</th>
            <th>Resolve </th>
            <th>date</th>
          </tr>
        </thead>
        <tbody>
     
          <?php  
                              $select_query = "select * from student_query where teacher_id = $teacher_id order by query_id DESC ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                              $count = 1;
                             while($res = mysqli_fetch_array($select_query_run))
                              {   
                              ?>
                              <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $res['student_msg']; ?></td>
                                <td><?php echo $res['teacher_response']; ?></td>
                                <td>
                                <button type="button" class="btn btn-primary"><a href="query.php?id=<?php echo $res['query_id']; ?>" class="text-white">Resolve</a></button>	
                                </td>
                                <td><?php echo date('F d, Y', strtotime($res['query_date'])); ?></td>

          </tr>
          <?php
          $count = $count +1 ;
                              }
                              ?>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>