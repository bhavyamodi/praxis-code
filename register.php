<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Institution Registration</title>
	<!--
    Template 2105 Input
	http://www.tooplate.com/view/2105-input
	-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/tooplate.css">
</head>
<?php 
 $emailErr = "";

include('database/dbconfig.php');
if(isset($_POST['submit']))
{
    $username = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $owner = $_POST['owner'];
    $cpassword = $_POST['confirmpassword'];
   // $a = uniqid(rand(),true);
 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      ?>
      <script type="text/javascript">
alert("Cannot register institution because of <?php echo $emailErr;?>");
</script>
<?php
    }else{
    $email_query = "SELECT * FROM institution WHERE inst_email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO institution (inst_name,inst_address,inst_contact,inst_email,inst_password,inst_owner) VALUES ('$username','$address','$mobile','$email','$password','$owner')";
            $query_run = mysqli_query($connection, $query);


            
            if($query_run){
                $last_id = mysqli_insert_id($connection);
            $query_insert = "INSERT INTO teacher (teacher_name,teacher_email,teacher_password,inst_id,createdon) VALUES ('$username','$email','$password','$last_id',now())";
            $run = mysqli_query($connection, $query_insert);
               echo '<script>alert("profile added succesfully")</script>';
                 
            }
            else 
            {
               // header('Location: register.php?notentered');
               // echo "profile not added";
                die("Connection failed: " . mysqli_error($connection));  
            }
        }
        else 
        {
            
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            echo "password does not match";
            header('Location: register.php');  
        }
    }

  }
}

?>

<body id="register">
    <div class="container justify-content-center">
        <div class="row tm-register-row">
            

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  tm-bg-black p-5 h-100">

                <form action="" method="post" >
                    

                    <div class="input-field">
                        <input placeholder="Institution Name" id="first_name" name="name" type="text" class="validate" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input placeholder="Owner Name" id="district" name="owner" type="text" class="validate" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input placeholder="Email" id="email" name="email" type="text" class="validate" autocomplete="off" required>
                    </div>
                    
                    <div class="input-field">
                        <input placeholder="Mobile" id="mobile" name="mobile" type="text" class="validate" autocomplete="off" required>
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

                   
                    <div class="text-right mt-4">
                        <button type="submit" name="submit" class="waves-effect btn-large btn-large-white px-4 black-text">SUBMIT</button>
                    </div>
                </form>
            </div>
             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <header class="font-weight-light tm-bg-black p-5 h-100 text-center">
                    <h5 class="mt-0 text-white">Registration Form</h5>
                    <p class="grey-text">Register Yourself with us & Start Teaching</p>
                    <br>
                    <button class="btn btn-info"><a href="../index.php">Go Back To Home!!</a></button>
                    <br><br><br>
                     <a href="login.php" class="waves-effect btn-large btn-large-white px-4 black-text">Login</a>
                </header>
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

    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
            $('select').formSelect();
        });
    </script>
</body>

</html>