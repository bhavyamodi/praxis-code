<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");

$id = $_GET['id'];

$query1 = "SELECT * FROM class WHERE class_id= $id";
$run1 = mysqli_query($connection,$query1);
$res1 = mysqli_fetch_array($run1);
$inst_id = $res1['inst_id'];
?>

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <h4 class="card-title text-center p-1 my-1">Class Name : <?php echo $res1['class_name']; ?>
        <button type="button" class="btn btn-outline-primary btn-icon-text float-right">
                      <a href="class.php">
                      <span>Back</span>
                      </a>
                    </button>  
        </h4>
          </div>
      </div>
      <div class="container-fluid col-8">
        <div class="text-center">
            <div class="card">
                  <div class="card-body">

                    
                    <h4 class="card-title">Subject Teacher
                    </h4><br>
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                            <th>Subject Name</th>
                            <th>Teacher</th>
                            </tr>
                          </thead>
                          <tbody>
                           <?php  
                              $select_query = "select * from subject where class_id=$id  ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              {
                               $topic_id = $res['subject_id'];
                             $topic = "SELECT * FROM class_teacher where subject_id = $topic_id ";
                             $topic_run = mysqli_query($connection, $topic); 
                             $res1 = mysqli_fetch_array($topic_run);
                             $teacher_id = $res1['teacher_id'];
                             $topic2 = "SELECT * FROM teacher where teacher_id = $teacher_id ";
                             $topic2_run = mysqli_query($connection, $topic2);   
                              ?>
                              <tr>
                                <td><?php echo $res['subject_name']; ?></td>      
                                <td><?php foreach($topic2_run as $topic2_row){ echo $topic2_row['teacher_name'];} ?></td>
                              <?php } ?>
                              </tr>
                          </tbody>
                        </table>
                    </div>
                  </div>
            </div>
        </div> 
      </div>
<?php 
include("includes/footer.php");
include("includes/scripts.php");

?>