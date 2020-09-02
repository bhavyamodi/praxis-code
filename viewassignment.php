<?php 
include("security1.php");
include("includes/header.php");
include("includes/teachernav.php");

$id = $_GET['id'];
?>
<div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">
                     <h3 class="text-white p-2">Assignment Submission
                      </h3>

                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                            <th>Student Name</th>
                            <th>Submitted File</th>
                            <th>Submission Date</th>
                            </tr>
                          </thead>
                          <tbody>
                             <?php  
                              $select_query = "select * from assignment_student where assignment_id = '$id' ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              { 
                              	$student_id = $res['student_id'];
                              	$select = "SELECT * FROM student where student_id = $student_id";
                              	$select_run =  mysqli_query($connection, $select);                   
                              ?>
                              <tr>
                              	<td><?php foreach($select_run as $course1_row){ echo $course1_row['student_name'];} ?></td>
                              	<td>
                                    <button type="button" class="btn btn-success">
                                    <a href="<?php echo $res['submit_file']; ?>" class="text-white">View Submission</a>
                                    </button>
                                </td>
                                <td><?php echo date('F d, Y', strtotime($res['submit_date'])); ?></td>                       
                               
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
include('includes/footer.php');
include('includes/scripts.php');
?>