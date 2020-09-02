<?php 
include("security1.php");
include("includes/header.php");
include("includes/teachernav.php");

$user=$_SESSION['teacher_name'];
    $query = "select * from teacher where teacher_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    // print_r($row);
    $id = $row['inst_id'];
    $teacher_id = $row['teacher_id'];
    $query1 = "select * from institution where inst_id = '$id' ";
    $run_query1 = mysqli_query($connection, $query1);
    $row1 = mysqli_fetch_array($run_query1);
    $image = $row1['inst_image'];
    $inst_name = $row1['inst_name'];

if(isset($_POST['submit'])){
  
$name = $_POST['name'];

$query_insert = " insert into notice_board (notice_msg, notice_type, teacher_id, notice_date) values ('$name','students','$teacher_id', now())";

$run = mysqli_query($connection, $query_insert);
if($run){
?>
 <script type="text/javascript">
alert("Notice published Successfully");
</script>
<?php
}else{
  die("Connection failed: " . mysqli_error($connection));
?>
 <script type="text/javascript">
alert("Notice cannot be publish right now. Please try again later");
</script>
<?php

}
}
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
              <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                            Teacher Name
                          </h3><br>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        
                      </div>
                    </div>
                    <h4 class="font-weight-normal float-right">
                      <?php

                             echo $_SESSION['teacher_name'];

                            ?>
                    </h4>
                  </div>
                </div>
              </div>
        <!--      <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                            <?php

                               $select_inst = "select * from teacher where inst_id = $id";
                               $select_inst_run = mysqli_query($connection, $select_inst);
                               $nums = mysqli_num_rows($select_inst_run);
                               echo $nums;
               
                            ?>
                          </h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Teachers</h6>
                  </div>
                </div>
              </div> -->

                <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
    <?php 

    $query = "SELECT * FROM class_teacher WHERE teacher_id = $teacher_id";
    $query_run = mysqli_query($connection, $query);
    $check_course = mysqli_num_rows($query_run)>0;
    if($check_course){
      while($row = mysqli_fetch_array($query_run)){
         $topic_id = $row['class_id'];
        $topic = "SELECT * FROM class where class_id = $topic_id ";
         $topic_run = mysqli_query($connection, $topic);
         $subject_id = $row['subject_id'];
        $subject = "SELECT * FROM subject where subject_id = $subject_id ";
         $subject_run = mysqli_query($connection, $subject);

        ?>
       <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                <div class="card text-center my-3 p-3">

        <h4 clas="card-title">
           <?php foreach($topic_run as $topic_row){ echo $topic_row['class_name'];} ?> 
        </h4>
        <p class="card-text">
                <?php foreach($subject_run as $topic1_row){ echo $topic1_row['subject_name'];} ?> 
                <h4>
                  Class Code :  <?php foreach($topic_run as $topic_row){ echo $topic_row['class_code'];} ?>
                </h4>         
        </p>
      </div>
      
    </div>
    <?php
      }
    }

    ?>
    
    
  </div>
              
    </div>          

    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Notice Board :
                    <button type="button" class="btn btn-outline-secondary float-right">
                       <a href="#modalLoginForm" class="smoothScroll text-white" data-toggle="modal" data-target="#modalLoginForm">
                    Share Something </a></button>
                    </h4>

                    <p class="card-description">
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Message</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php
                         $select_query = "select * from notice_board where inst_id = $id order by notice_id DESC";
                            $select_query_run =  mysqli_query($connection, $select_query);
                            $nums = mysqli_num_rows($select_query_run);
                            while($res = mysqli_fetch_array($select_query_run)){
                            ?>
                            <tr>
                                <td><?php echo $res['notice_msg']; ?></td>
                                <td><?php echo date('F d, Y', strtotime($res['notice_date'])); ?></td>
                            </tr>


                 <?php
              }

              ?>      
               <?php
                         $select_query = "select * from notice_board where teacher_id = $teacher_id order by notice_id DESC";
                            $select_query_run =  mysqli_query($connection, $select_query);
                            $nums = mysqli_num_rows($select_query_run);
                            while($res = mysqli_fetch_array($select_query_run)){
                            ?>
                            <tr>
                                <td><?php echo $res['notice_msg']; ?></td>
                                <td><?php echo date('F d, Y', strtotime($res['notice_date'])); ?></td>
                                <td><button class="btn btn-danger"><a href="deletenotice.php?id=<?php echo $res['notice_id'];?>" class="text-white">Delete</button></td>
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



                              