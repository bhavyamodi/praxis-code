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

if(isset($_POST['coursebtn']))
{
    $topic = $_POST['topic'];
     $id = $_POST['id'];

   
            $query = "INSERT INTO syllabus (topic_name, subject_id) VALUES ('$topic','$id')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                
                ?>
 <script type="text/javascript">
alert("Topic added successfully");
</script>
<?php
            }
            else 
            {
                
               ?>
 <script type="text/javascript">
alert("Topic cannot be added right now!!");
</script>
<?php 
            }
        
    }
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Syllabus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">

        <div class="modal-body">
           <div class="mb-4">
                      <label data-error="wrong" data-success="right">Topic Name</label>
                      <select class="form-control text-white" name="id">
                           <?php
                              $rs=mysqli_query($connection,"Select * from class_teacher where teacher_id = '$teacher_id' ");
                              while($res=mysqli_fetch_array($rs))
                              {
                              $sub = $res['subject_id'];
                               $query=mysqli_query($connection,"Select * from subject where subject_id = '$sub' ");
                                  while($row=mysqli_fetch_array($query))
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
                                }
                                  ?>
                      </select>
                      </div>
                <div class="form-group">
                <label>Topic</label>
                <input type="text" name="topic" class="form-control text-white" placeholder="Enter Topic" required>
            </div>

        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="coursebtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid col-8">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-white">Syllabus 
            <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#addadminprofile">
              Add Topic 
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Topic name </th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
     
          <?php  
                              $select_query = "select * from syllabus where subject_id ='$subject_id' ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              {   
                              ?>
                              <tr>
                                <td><?php echo $res['topic_name']; ?></td>
                                <td> <button type="submit" name="update_btn" class="btn btn-danger"><a href="deletesyllabus.php?id=<?php echo $res['topic_id']; ?>" class="text-white">Delete</a></button></td>
                                

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