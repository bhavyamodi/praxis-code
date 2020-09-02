<?php 
session_start();
include 'database/dbconfig.php';

if(isset($_REQUEST["submit"])){
    $user=$_REQUEST["student_email"];
    $password=$_REQUEST["student_password"];
    $select = ("select * from student where student_email='$user' && student_password = '$password'");
    $query_run =mysqli_query($connection,$select);
    $res = mysqli_num_rows($query_run);

        if($res == true){
        $_SESSION['student_email']= $user;

        $email_pass = mysqli_fetch_assoc($query_run);
        $db_pass = $email_pass['student_password'];

        $_SESSION['student_name'] = $email_pass['student_name'];
        $_SESSION['student_id'] = $email_pass['student_id'];
        header("location: studentindex.php");
    }
    else{
        $_SESSION['status'] = "Invalid Email or Password !!";
        $_SESSION['status_code'] = "error";

        header("location:studentlogin.php?failed");
    }


}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Login</title>
  <!--
    Template 2105 Input
  http://www.tooplate.com/view/2105-input
  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/tooplate.css">
</head>

<body id="login">

    <div class="container">
        <div class="row tm-register-row tm-mb-35">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 tm-login-l">
                <form action="" method="post" class="tm-bg-black p-5 h-100">
                    <div class="input-field">
                        <input placeholder="Enter Email Address..." id="username" name="student_email" type="email" class="validate" autocomplete="off" required>
                    </div>
                    <div class="input-field mb-5">
                        <input placeholder="Enter Your Password..." id="password" name="student_password" type="password" class="validate" autocomplete="off" required>
                    </div>
                    <div class="tm-flex-lr">
                        <a href="#" class="white-text small">Forgot Password?</a>
                        <button type="submit" name="submit" class="waves-effect btn-large btn-large-white px-4 black-text rounded-0">Login</button>
                    </div>
                </form>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 tm-login-r">
                <header class="font-weight-light tm-bg-black p-5 h-100 text-center">
                    <h3 class="mt-0 text-white font-weight-light text-center">Login</h3>
                    <p>Welcome Back </p>
                    <p class="mb-0">Login with your registered email address and password.</p>
                    <br>
                    <button class="btn btn-info"><a href="../index.php">Go Back To Home!!</a></button>
                </header>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ml-auto mr-0 text-center">
                <a href="studentregister.php" class="waves-effect btn-large btn-large-white px-4 black-text rounded-0">Create New Account</a>
            </div>
        </div>
        <footer class="row tm-mt-big mb-3">
            <div class="col-xl-12 text-center">
                <p class="d-inline-block tm-bg-black white-text py-2 tm-px-5">
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