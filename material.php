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


if(isset($_POST['image'])){
    $filename = $_FILES["uploadfile"]["name"];
    $tempname= $_FILES["uploadfile"]["tmp_name"];
    $file = $_FILES["uploadfile"]['tmp_name'];
    $folder = "files/".$filename;
    move_uploaded_file($tempname, $folder);

    $topic = $_POST['topic'];
          
              $insertquery = "Insert into notes (`teacher_id`,`class_id`, `note_topic`, `note_file`, note_date) values ('$teacher_id','$class_id','$topic','$folder', now()) ";
              $run_query = mysqli_query($connection, $insertquery);
              if($run_query){
                ?>
                <script>
                  alert("Notes uploaded");
                </script>
                <?php
              }else{
               die("Connection failed: " . mysqli_error($connection));
                ?>
                <script>
                  alert("Notes cannot be uploaded");
                </script>
                <?php
              }
      }
?>

<div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">
                     <h6 class="m-0 font-weight-bold text-white">Notes:
            <button class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#addadminprofile">
            Upload Notes
            </button>
                      </h6>
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                            <th>Note Topic</th>
                            <th>View / Download File</th>
                            <th>Upload Date</th>
                            <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                             <?php  
                              $select_query = "select * from notes where teacher_id = '$teacher_id' ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              { 
                             
                              ?>
                              <tr>
                                <td><?php echo $res['note_topic']; ?></td>
                                
                                 <td>
                                    <button type="button" class="btn btn-success">
                                    <a href="<?php echo $res['note_file']; ?>" class="text-white">View</a>
                                    </button>
                                </td>
                                <td><?php echo date('F d, Y', strtotime($res['note_date'])); ?></td>
                               
                                
                                <td><button type="button" class="btn btn-danger">
                                    <a href="deletenote.php?id=<?php echo $res['note_id']; ?>" class="text-white">Delete</a>
                                    </button>
                                </td></td>
                               
                              <?php } ?>
                              </tr>
                          </tbody>
                        </table>
                    </div>
                  </div>
            </div>
        </div>
 </div>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Notes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">
                <label>Name </label>
                <input type="text" name="topic" class="form-control" placeholder=" Name.." required><br>
                <label>Select File</label><br>
                 <input type="file" name="uploadfile" value="" /><br><br>
            </div>  
       </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" name="image" value="Upload Assignment" class="btn btn-outline-primary">
        </div>
      </form>

    </div>
  </div>
</div>
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>

