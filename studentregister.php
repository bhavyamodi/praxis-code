<?php
session_start();
include('database/dbconfig.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Registration</title>
	<!--
    Template 2105 Input
	http://www.tooplate.com/view/2105-input
	-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/tooplate.css">
</head>

<body id="register">
    <div class="container justify-content-center">
        <div class="row tm-register-row">
            

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  tm-bg-black p-5 h-100">
                <header class="text-center">
                    
                
                </header>

                <form action="" method="post" >
                    

                    <div class="input-field">
                        <input placeholder="Student Name" id="first_name" name="name" type="text" class="validate" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input placeholder="Email" id="email" name="email" type="text" class="validate" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input placeholder="Mobile" id="mobile" name="mobile" type="text" class="validate" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input placeholder="Gender" id="district" name="gender" type="text" class="validate" autocomplete="off" required>
                    </div>

                    <div class="input-field">
                        <input placeholder="Address" id="address" name="address" type="text" class="validate" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                    <input type="password" name="password" class="validate" placeholder="Password" autocomplete="off" required>
                    </div>

                    <div class="input-field">
                    <input type="password" name="confirmpassword" class="validate" placeholder="Confirm Password" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                     <input type="text" name="id" class="validate" placeholder="Class Code" autocomplete="off" required>
                </div>    
                    <div class="text-right mt-4">
                        <button type="submit" name="submit" class="waves-effect btn-large btn-large-white px-4 black-text">SUBMIT</button>
                    </div>
                </form>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <header class="font-weight-light tm-bg-black p-5 h-100 text-center">
                    <h5 class="mt-0 text-white">Registration Form</h5>
                    <p class="grey-text">Register Yourself with us & Start learning</p>
                    <br>
                    <button class="btn btn-info"><a href="../index.php">Go Back To Home!!</a></button>
                    <br><br><br>
                     <a href="studentlogin.php" class="waves-effect btn-large btn-large-white px-4 black-text">Login</a>
                </header>
            </div>
        </div>
<?php
if(isset($_POST['submit']))
{
    $username = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $class_code = $_POST['id'];

     $query = "SELECT * FROM class WHERE class_code ='$class_code' ";
    $query_run = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($query_run);
    $inst_id = $row['inst_id'];
    $class_id = $row['class_id'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      ?>
      <script type="text/javascript">
alert("Cannot register institution because of <?php echo $emailErr;?>");
</script>
<?php
    }else{

    $email_query = "SELECT * FROM student WHERE student_email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        ?><script>alert('Email Already Taken. Please Try Another one.')</script>
        <?php
    }

    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO request (student_name,student_email,student_mobile,student_gender,student_address,student_password,institution_id,class_id,requested_on) VALUES ('$username','$email','$mobile','$gender','$address','$password','$inst_id','$class_id', now())";
            $query_run = mysqli_query($connection, $query);
            if($query_run){
        
             $last_id = mysqli_insert_id($connection);
               $query = "SELECT * FROM request WHERE request_id= $last_id";
             $run = mysqli_query($connection,$query);
             $res = mysqli_fetch_array($run);
             $institution_id = $res['institution_id'];


?>
                <script>alert('Your account request is now pending for approval. Please wait for confirmation. Thank you.')</script>
                <?php


            }else{
                echo "error:" .mysqli_error($connection);
            ?><script>alert("Instructor id does not exists !!")</script>
            <?php
        
            }
        }
        else 
        {
            
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            echo "<script>alert('password does not match')</script>";
        }
    }
}
}
?>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ml-auto mr-0 text-center">
               
            </div>
        </div>
            
            
        </div>
        <footer class="row tm-mt-big mb-3">
            <div class="col-xl-12">
                <p class="text-center grey-text text-lighten-2 tm-footer-text-small">
                    Copyright &copy; 2020 PraxisNation
                </p>
            </div>
        </footer>
    </div>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
            $('select').formSelect();
        });
    </script>
</body>

</html>