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

?>
<div class="card">
  <div class="card-body text-center p-3" style="background-color: rgba(245, 245, 245, 0.1); "><?php echo $inst_name ?></div>
</div>
    <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
             <img src="<?php echo $image; ?>" class="img-fluid mx-auto d-block" alt="Institution Image" />
         </div>
    </div>
   
              
  <div class="row">
    <?php 

    $query = "SELECT * FROM class_teacher WHERE class_id = $class_id";
    $query_run = mysqli_query($connection, $query);
    $check_course = mysqli_num_rows($query_run)>0;
    if($check_course){
      while($row = mysqli_fetch_array($query_run)){
         $topic_id = $row['teacher_id'];
        $topic = "SELECT * FROM teacher where teacher_id = $topic_id ";
         $topic_run = mysqli_query($connection, $topic);
         $subject_id = $row['subject_id'];
        $subject = "SELECT * FROM subject where subject_id = $subject_id ";
         $subject_run = mysqli_query($connection, $subject);

        ?>
       <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card text-center my-3 p-3">

        <h4 clas="card-title">
           <?php foreach($topic_run as $topic_row){ echo $topic_row['teacher_name'];} ?> 
        </h4>
        <p class="card-text">
                <?php foreach($subject_run as $topic1_row){ echo $topic1_row['subject_name'];} ?>          
        </p>
      </div>
      
    </div>
    <?php
      }
    }

    ?>
    
    
  </div>         

    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Notice Board :</h4>

                    <p class="card-description">
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Notice by:</th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php
                         $select_query = "select * from notice_board where inst_id = $id order by notice_id DESC";
                            $select_query_run =  mysqli_query($connection, $select_query);
                            $nums = mysqli_num_rows($select_query_run);
                           
                            while($res = mysqli_fetch_array($select_query_run)){
                               $res['inst_id'] = 'Admin';
                            ?>
                            <tr>
                                <td><?php echo $res['notice_msg']; ?></td>
                                <td><?php echo date('F d, Y', strtotime($res['notice_date'])); ?></td>
                                <td><?php echo $res['inst_id']; ?></td>
                            </tr>


                 <?php
              }

              ?>      
               <?php
                $query = "SELECT * FROM class_teacher WHERE class_id = $class_id";
                     $query_run = mysqli_query($connection, $query);
                      while($row = mysqli_fetch_array($query_run)){
                         $topic_id = $row['teacher_id'];
                         $topic = "SELECT * FROM teacher where teacher_id = $topic_id ";
                         $topic_run = mysqli_query($connection, $topic);

                         $select_query = "select * from notice_board where teacher_id = $topic_id order by notice_id DESC";
                            $select_query_run =  mysqli_query($connection, $select_query);
                            $nums = mysqli_num_rows($select_query_run);
                            while($res = mysqli_fetch_array($select_query_run)){
                              $topic_id = $res['teacher_id'];
                         $topic = "SELECT * FROM teacher where teacher_id = $topic_id ";
                         $topic_run = mysqli_query($connection, $topic);

                            ?>
                            <tr>
                                <td><?php echo $res['notice_msg']; ?></td>
                                <td><?php echo date('F d, Y', strtotime($res['notice_date'])); ?></td>
                               <td> <?php foreach($topic_run as $topic_row){ echo $topic_row['teacher_name'];} ?></td>
                            </tr>


                 <?php
               }
              }

              ?> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-xl-6 grid-margin stretch-card">
                
      </div>
       
    </div>

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title w-100 font-weight-bold">Share Something</h4>
        
      </div>
      <div class="modal-body mx-3">
       
    <form action="" method="post" class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="mb-4">
          <i class="fa fa-envelope prefix grey-text"></i>
          <label data-error="wrong" data-success="right">Message</label>
          <input type="text" name="name" class="form-control text-white" required>
        </div>
        <br>
        <div class="mb-4">
            <input type="submit" name="submit" class="form-control btn btn-primary" value="SUBMIT">
                  </div>
    </form>

     
    </div>
  </div>
</div>
</div>
<?php 
include("includes/footer.php");
include("includes/scripts.php");

?>



                              