<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
$user=$_SESSION['inst_name'];
    $query = "select * from institution where inst_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    // print_r($row);
    $id = $row['inst_id'];
if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      ?>
       <script type="text/javascript">
         alert("Please enter a valid email address");
         </script>
      <?php
    }else{
    $email_query = "SELECT * FROM teacher WHERE teacher_email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
       ?>
          <script type="text/javascript">
         alert("Email already taken");
         </script>
      <?php
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO teacher (teacher_name,teacher_email,teacher_mobile,teacher_password, createdon,inst_id) VALUES ('$username','$email','$mobile','$password',now(), '$id')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                
                 ?>
          <script type="text/javascript">
         alert("Teacher added successfully.");
         </script>
      <?php            }
            else 
            {
                
                ?>
          <script type="text/javascript">
         alert("Teacher cannot be added right now. Please try again later");
         </script>
      <?php 
            }
        }
        else 
        {
            
            ?>
          <script type="text/javascript">
         alert("Password & confirm password does not match!");
         </script>
      <?php  
        }
    }
  }
}
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Teacher Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Teacher name </label>
                <input type="text" name="username" class="form-control text-white" placeholder="Enter teacher name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control text-white" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="number" name="mobile" class="form-control text-white" placeholder="Enter Mobile" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control text-white" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control text-white" placeholder="Confirm Password" required>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Teacher Profiles 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Teacher Profile 
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Username </th>
            <th>Email </th>
            <th>Mobile</th>
            <th>Created On</th>
          </tr>
        </thead>
        <tbody>
     
          <?php  
                              $select_query = "select * from teacher where inst_id = '$id' ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              {   
                              ?>
                              <tr>
                                <td><?php echo $res['teacher_name']; ?></td>
                                <td><?php echo $res['teacher_email']; ?></td>
                                <td><?php echo $res['teacher_mobile']; ?></td>
                                <td><?php echo date('F d, Y', strtotime($res['createdon']));  ?></td>
                                
                                

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
include('includes/scripts.php');
include('includes/footer.php');
?>