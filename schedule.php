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
    $subject_id = $row1['subject_id'];

 if(isset($_POST['submit'])){
      $topic_id = $_POST['id'];
      $s_date = $_POST['date'];
      $s_time = $_POST['time'];

       $insertquery = "INSERT INTO schedule(`s_date`,`s_time`,`a_date`,`a_time`,`topic_id`,`subject_id`) VALUES ('$s_date','$s_time',curdate(),now(),'$topic_id','$subject_id')";
              $run_query = mysqli_query($connection, $insertquery);
              if($run_query){
                ?>
                <script>
                  alert("Scheduled created Successfully");

                </script>           
                <?php
                }else{
                   echo mysqli_connect_error();
                ?>
                <script>
                  alert("Schedule cannot be created right now !!");
                </script>
                <?php
                }
              }
?>


<!-- Add Student modal-->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form name="form1" method="post" action="" onSubmit="return check();">
      <table class="table table-striped">
   
       <tr>
         <td width="49%" height="32"><div align="left"><strong>Enter Topic Name</strong></div></td>
         <td width="3%" height="5">  
         <td width="48%" height="32">
           <select class="form-control text-white" name="id">
           <?php
            $rs1=mysqli_query($connection,"Select * from syllabus where subject_id='$subject_id' order by  subject_id");

             while($row1=mysqli_fetch_array($rs1))
             {
                if($row1[0]==$courseid)
                  {
                  echo "<option value='$row1[0]' selected>$row1[1]</option>";
                  }
            else
            {
            echo "<option value='$row1[0]'>$row1[1]</option>";
            }
            }
            ?>
            </select>
            </tr>
        
             <tr>
               <td height="26"><div align="left"><strong> Enter Schduled Date </strong></div></td>
                    <td>&nbsp;</td>
                <td><input type="date" id="start" name="date" value="2020-01-01" min="2020-08-01" max="2031-12-31"></td>
             </tr>
             <tr>
                   <td height="26"><div align="left"><strong>Enter Schedule Time </strong></div></td>
                   <td>&nbsp;</td>
                   <td><input type="time" id="time" name="time" value="00:00"></td>
             </tr>
 
  

              <tr>
                   <td height="26"></td>
                   <td>&nbsp;</td>
                   <td><input class="btn btn-primary" type="submit" name="submit" ></td>
             </tr>
     </table>
    </form>
  

</div>
</div>
</div>

<!-- view Student modal-->





<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3"> 
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addadminprofile">
              Create Schedule  
            </button>
  </div>
<div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Topic name </th>
            <th>Schedule Date & Time</th>
            <th>Actual Date & Time</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Update</th>

          </tr>
        </thead>
        <tbody>
     
          <?php  
                              $select_query3 = "select * from schedule where subject_id = '$subject_id' ";
                              $select_query3_run =  mysqli_query($connection, $select_query3);
                              $num = mysqli_num_rows($select_query3_run);
                             while($resu = mysqli_fetch_array($select_query3_run))
                              {   
                                 $topic_id = $resu['topic_id'];
                                 $topic = "SELECT * FROM syllabus where topic_id = $topic_id ";
                                 $topic_run = mysqli_query($connection, $topic);
                              ?>
                              <tr>
                  
                                <td><?php foreach($topic_run as $topic_row){ echo $topic_row['topic_name'];} ?>  </td>
                                <td><?php echo date('F d, Y', strtotime($resu['s_date'])); ?> - <span><?php echo date('h:i A',strtotime($resu['s_time'])); ?></td>
                                <td><?php echo date('F d, Y', strtotime($resu['a_date'])); ?> <span><?php echo date('h:i A',strtotime($resu['a_time'])); ?></td>
                                <td><?php echo $resu['schedule_status']?></td>

                                <td> <button type="submit" name="update_btn" class="btn btn-danger"><a href="deleteschedule.php?id=<?php echo $resu['schedule_id']; ?>" class="text-white">Delete</a></button></td>
                                <td> <button type="submit" name="update_btn" class="btn btn-info"><a href="updateschedule.php?id=<?php echo $resu['schedule_id']; ?>" class="text-white">Update</a></button></td>
                             
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




<!-- /.container-fluid -->

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>